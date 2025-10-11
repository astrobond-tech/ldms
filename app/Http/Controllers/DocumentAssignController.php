<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentIssue;

class DocumentAssignController extends Controller
{
    public function index()
    {
        $assignedDocuments = DocumentIssue::with(['user', 'document', 'issuer'])->whereColumn('quantity', '>', 'returned_quantity')->get();
        return view('assign.index', compact('assignedDocuments'));
    }

    public function create()
    {
        return view('assign.create');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make(
            $request->all(),
            [
                'client_id' => 'required|exists:users,id',
                'document_id' => 'required|exists:documents,id',
                'quantity' => 'required|integer|min:1',
                'issue_date' => 'required|date',
                'due_date' => 'nullable|date|after_or_equal:issue_date',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $document = \App\Models\Document::with('essential')->find($request->document_id);
        $essential = $document->essential;

        if ($essential && $essential->copies_total !== null) {
            if ($essential->copies_available < $request->quantity) {
                return redirect()->back()->with('error', __('Not enough copies available to assign.'));
            }
        }

        $issue = new DocumentIssue();
        $issue->document_id = $request->document_id;
        $issue->essential_id = $essential ? $essential->id : null;
        $issue->user_id = $request->client_id;
        $issue->issued_by = \Auth::id();
        $issue->issue_date = $request->issue_date;
        $issue->due_date = $request->due_date;
        $issue->quantity = $request->quantity;
        $issue->status = 'issued';
        $issue->save();

        if ($essential && $essential->copies_total !== null) {
            $essential->copies_available -= $request->quantity;
            $essential->save();
        }

        return redirect()->route('assign.index')->with('success', __('Document assigned successfully.'));
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
