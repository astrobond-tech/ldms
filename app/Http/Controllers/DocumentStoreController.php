<?php

namespace App\Http\Controllers;

use App\Models\DocumentStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class DocumentStoreController extends Controller
{
    public function index()
    {
        $documents = DocumentStore::orderBy('id', 'desc')->get();
        return view('document_store.index', compact('documents'));
    }

    public function create()
    {
        return view('document_store.create');
    }

    // Store new book in database
 // <--- ensure this is at top of the controller

public function store(Request $request)
{
    $rules = [
        'document_name'         => 'required|string|max:355',
        'description'           => 'nullable|string',
        'availability_type'     => 'required|in:offline,online,both',
        'room_no'               => 'nullable|integer',
        'rack_no'               => 'nullable|integer',
        'shelf_no'              => 'nullable|integer',
        'box_no'                => 'nullable|integer',
    ];

    if (in_array($request->availability_type, ['online', 'both'])) {
        $rules['document_file'] = 'required|file|mimes:pdf|max:10240';
    } else {
        $rules['document_file'] = 'nullable|file|mimes:pdf|max:10240';
    }

    if (in_array($request->availability_type, ['offline', 'both'])) {
        $rules['room_no']  = 'required|integer';
        $rules['rack_no']  = 'required|integer';
        $rules['shelf_no'] = 'required|integer';
        $rules['box_no']   = 'required|integer';
    }

    $request->validate($rules);

    $document = new DocumentStore();
    $document->document_name     = $request->document_name;
    $document->description       = $request->description;
    $document->availability_type = $request->availability_type;
    $document->room_no           = $request->room_no;
    $document->rack_no           = $request->rack_no;
    $document->shelf_no          = $request->shelf_no;
    $document->box_no            = $request->box_no;
    $document->created_by        = auth()->id();
    $document->user_id           = auth()->id();

    if ($request->hasFile('document_file')) {
        $file = $request->file('document_file');

        // extra-safe extension check
        if (strtolower($file->getClientOriginalExtension()) !== 'pdf') {
            return back()->withErrors(['document_file' => __('Only PDF files are allowed.')]);
        }

        $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());

        // storeAs returns the saved path relative to disk root: "document_store/filename"
        $path = $file->storeAs('document_store', $filename, 'public');

        // Save the path (so Storage::disk('public')->delete($document->document_file) works later)
        $document->document_file = $path;
    }

    // You don't need to set created_at manually if your model uses timestamps,
    // but if you prefer:
    $document->created_at = Carbon::now();
echo $trs.'HAAAA=' ; die();
    // Save wrapped with try/catch so you get the real error if there's still a problem
        $trs =   $document->save();
      echo $trs.'HAAAA=' ; die();
    try {
      $trs =   $document->save();
      echo $trs ; die();
    } catch (\Throwable $e) {
        \Log::error('DocumentStore save failed: '.$e->getMessage());
        return back()->withErrors(['error' => 'Failed to save document: '.$e->getMessage()]);
    }

    return redirect()->route('document-store.index')->with('success', __('Document successfully created!'));
}



    public function show(DocumentStore $documentStore)
    {
        return view('document_store.show', compact('documentStore'));
    }

    public function edit(DocumentStore $documentStore)
    {
        return view('document_store.edit', compact('documentStore'));
    }

    public function update(Request $request, DocumentStore $documentStore)
    {
        $request->validate([
            'document_name' => 'required|string|max:355',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx',
            'room_no'       => 'required|integer',
            'rack_no'       => 'required|integer',
            'shelf_no'      => 'required|integer',
            'box_no'        => 'required|integer',
            'description'   => 'nullable|string',
        ]);

        if($request->hasFile('document_file')) {
            // Delete old file
            if($documentStore->document_file) {
                Storage::disk('public')->delete($documentStore->document_file);
            }
            $documentStore->document_file = $request->file('document_file')->store('documents', 'public');
        }

        $documentStore->update([
            'document_name' => $request->document_name,
            'description'   => $request->description,
            'room_no'       => $request->room_no,
            'rack_no'       => $request->rack_no,
            'shelf_no'      => $request->shelf_no,
            'box_no'        => $request->box_no,
        ]);

        return redirect()->route('document-store.index')->with('success', 'Document updated successfully!');
    }

    public function destroy(DocumentStore $documentStore)
    {
        if($documentStore->document_file){
            Storage::disk('public')->delete($documentStore->document_file);
        }
        $documentStore->delete();
        return redirect()->route('document-store.index')->with('success', 'Document deleted successfully!');
    }
}
