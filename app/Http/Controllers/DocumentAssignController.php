<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentIssue;
use Carbon\Carbon;

class DocumentAssignController extends Controller
{
    public function index(Request $request)
    {
        $query = DocumentIssue::with(['user', 'document', 'issuer'])
                              ->whereColumn('quantity', '>', 'returned_quantity');

        // Filter by Client Name
        if ($request->filled('client_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->client_name . '%')
                  ->orWhere('last_name', 'like', '%' . $request->client_name . '%');
            });
        }

        // Filter by Document Name
        if ($request->filled('document_name')) {
            $query->whereHas('document', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->document_name . '%');
            });
        }

        // Filter by specific Issue Date
        if ($request->filled('issue_date')) {
            $query->whereDate('issue_date', $request->issue_date);
        }

        // Filter by specific Due Date
        if ($request->filled('due_date')) {
            $query->whereDate('due_date', $request->due_date);
        }

        // Filter by Due Date Range
        if ($request->filled('due_date_range')) {
            switch ($request->due_date_range) {
                case 'today':
                    $query->whereDate('due_date', \Carbon\Carbon::today());
                    break;
                case 'tomorrow':
                    $query->whereDate('due_date', \Carbon\Carbon::tomorrow());
                    break;
                case 'next_7_days':
                    $query->whereBetween('due_date', [\Carbon\Carbon::today(), \Carbon\Carbon::today()->addDays(7)]);
                    break;
            }
        }

        $assignedDocuments = $query->get();

        return view('assign.index', compact('assignedDocuments'));
    }

    public function create()
    {
        return view('assign.create');
    }

    public function store(Request $request)
{
    // More thorough validation
    $validator = \Validator::make(
        $request->all(),
        [
            'client_id' => 'required|integer|exists:users,id',
            'document_id' => 'required|integer|exists:documents,id',
            'quantity' => 'required|integer|min:1',
            'issue_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d|after_or_equal:issue_date',
        ],
        [
            'client_id.required' => __('Client must be selected.'),
            'client_id.exists' => __('Selected client does not exist.'),
            'document_id.required' => __('Document must be selected.'),
            'document_id.exists' => __('Selected document does not exist.'),
            'quantity.required' => __('Quantity is required.'),
            'quantity.min' => __('Quantity must be at least 1.'),
            'issue_date.required' => __('Issue date is required.'),
            'issue_date.date_format' => __('Issue date format is invalid.'),
            'due_date.required' => __('Due date is required.'),
            'due_date.date_format' => __('Due date format is invalid.'),
            'due_date.after_or_equal' => __('Due date must be after or equal to issue date.'),
        ]
    );

    if ($validator->fails()) {
        $messages = $validator->getMessageBag();
        return redirect()->back()->withInput()->with('error', $messages->first());
    }

    try {
        $document = \App\Models\Document::with('essential')->find($request->document_id);

        if (!$document) {
            return redirect()->back()->with('error', __('Document not found.'));
        }

        $essential = $document->essential;

        // Check available copies
        if ($essential && $essential->copies_total !== null) {
            $availableCopies = $essential->copies_available ?? 0;
            if ($availableCopies < $request->quantity) {
                return redirect()->back()->withInput()->with('error', __('Not enough copies available to assign. Available: ' . $availableCopies));
            }
        }

        // Create new issue record
        $issue = new DocumentIssue();
        $issue->document_id = $request->document_id;
        $issue->essential_id = $essential ? $essential->id : null;
        $issue->user_id = $request->client_id;
        $issue->issued_by = \Auth::id();
        $issue->issue_date = \Carbon\Carbon::createFromFormat('Y-m-d', $request->issue_date);
        $issue->due_date = \Carbon\Carbon::createFromFormat('Y-m-d', $request->due_date);
        $issue->quantity = $request->quantity;
        $issue->returned_quantity = 0;
        $issue->status = 'issued';
        $issue->save();

        // Update available copies
        if ($essential && $essential->copies_total !== null) {
            $essential->copies_available -= $request->quantity;
            $essential->save();
        }

        return redirect()->route('assign.index')->with('success', __('Document assigned successfully.'));
    } catch (\Exception $e) {
        \Log::error('Document assignment error: ' . $e->getMessage());
        return redirect()->back()->withInput()->with('error', __('An error occurred while assigning the document. Please try again.'));
    }
}

    public function returnModal($id)
    {
        $issue = DocumentIssue::with('document.essential', 'user')->find($id);
        return view('assign.return', compact('issue'));
    }

    public function returnStore(Request $request, $id)
    {
        $validator = \Validator::make(
            $request->all(),
            [
                'return_quantity' => 'required|integer|min:1',
                'return_date' => 'required|date',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $issue = DocumentIssue::with('document.essential')->find($id);
        if (!$issue) {
            return redirect()->back()->with('error', __('Issue record not found.'));
        }

        $remaining_to_return = $issue->quantity - $issue->returned_quantity;
        if ($request->return_quantity > $remaining_to_return) {
            return redirect()->back()->with('error', __('Cannot return more copies than were issued.'));
        }

        $issue->returned_quantity += $request->return_quantity;
        $issue->return_date = $request->return_date;
        $issue->return_notes = $request->return_notes;

        if ($issue->returned_quantity >= $issue->quantity) {
            $issue->status = 'returned';
        }

        $issue->save();

        $essential = $issue->document->essential;
        if ($essential && $essential->copies_total !== null) {
            $essential->copies_available += $request->return_quantity;
            $essential->save();
        }

        return redirect()->route('assign.index')->with('success', __('Document returned successfully.'));
    }

    public function searchClients(Request $request)
    {
        $search = $request->input('search');
        $clients = \App\Models\User::where('type', 'client')
            ->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->get();

        $response = [];
        foreach ($clients as $client) {
            $response[] = [
                'id' => $client->id,
                'text' => $client->first_name . ' ' . $client->last_name . ' - ' . $client->email,
            ];
        }

        return response()->json($response);
    }

    public function searchDocuments(Request $request)
    {
        $search = $request->input('search');
        $documents = \App\Models\Document::with('essential')
            ->where('archive', 0)
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orWhereHas('essential', function ($q) use ($search) {
                $q->where('author', 'like', "%{$search}%")
                    ->orWhere('published_year', 'like', "%{$search}%")
                    ->orWhere('clipping_date', 'like', "%{$search}%");
            })
            ->get();

        $response = [];
        foreach ($documents as $document) {
            $response[] = [
                'id' => $document->id,
                'text' => $document->name . ' - ' . ucwords(str_replace('_', ' ', optional($document->essential)->document_type)),
            ];
        }

        return response()->json($response);
    }

    public function getDocumentDetails($id)
    {
        $document = \App\Models\Document::with('essential')->find($id);
        return response()->json($document);
    }
}
