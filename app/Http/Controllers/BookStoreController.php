<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookStore;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class BookStoreController extends Controller
{
    // Display all books
    public function index(Request $request)
    {
        $books = BookStore::orderBy('id', 'desc')->get();
        return view('book_store.index', compact('books'));
    }

    // Show form to create new book
    public function create()
    {
        return view('book_store.create');
    }

    // Store new book in database
    public function store(Request $request)
    {
       
        $rules = [
            'book_name'          => 'required|string|max:355',
            'description'        => 'nullable|string',
            'availability_type'  => 'required|in:offline,online,both',
            'room_no'            => 'nullable|integer',
            'rack_no'            => 'nullable|integer',
            'shelf_no'           => 'nullable|integer',
            'box_no'             => 'nullable|integer',
        ];

        // If availability_type is online or both, book_file is required
        if (in_array($request->availability_type, ['online', 'both'])) {
            $rules['book_file'] = 'required|file|mimes:pdf|max:10240';
        } else {
            // For offline only, book_file is optional
            $rules['book_file'] = 'nullable|file|mimes:pdf|max:10240';
        }

        // For offline or both, location fields are required
        if (in_array($request->availability_type, ['offline', 'both'])) {
            $rules['room_no'] = 'required|integer';
            $rules['rack_no'] = 'required|integer';
            $rules['shelf_no'] = 'required|integer';
            $rules['box_no'] = 'required|integer';
        }

        $request->validate($rules);

        $book = new BookStore();
        $book->book_name = $request->book_name;
        $book->description = $request->description;
        $book->availability_type = $request->availability_type;
        $book->room_no = $request->room_no;
        $book->rack_no = $request->rack_no;
        $book->shelf_no = $request->shelf_no;
        $book->box_no = $request->box_no;
        $book->created_by = auth()->id();
        $book->user_id = auth()->id();
    
        // Handle file upload only if provided and not offline-only
        if ($request->hasFile('book_file')) {
            $file = $request->file('book_file');

            // Validate that it's actually a PDF
            if ($file->getClientOriginalExtension() !== 'pdf') {
                return back()->withErrors(['book_file' => __('Only PDF files are allowed.')]);
            }

            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->storeAs('book_store', $filename, 'public');
            $book->{'book-file'} = $filename;
        }

        $book->created_at = Carbon::now();
        $book->save();
        

        return redirect()->route('book-store.index')->with('success', __('Book successfully created!'));
    }

    // Show edit form
    public function edit($id)
    {
        $book = BookStore::findOrFail($id);
        return view('book_store.edit', compact('book'));
    }

    // Update book
    public function update(Request $request, $id)
    {
        $book = BookStore::findOrFail($id);

        $rules = [
            'book_name'          => 'required|string|max:355',
            'description'        => 'nullable|string',
            'availability_type'  => 'required|in:offline,online,both',
            'room_no'            => 'nullable|integer',
            'rack_no'            => 'nullable|integer',
            'shelf_no'           => 'nullable|integer',
            'box_no'             => 'nullable|integer',
        ];

        // If availability_type is online or both, book_file can be updated
        if (in_array($request->availability_type, ['online', 'both'])) {
            $rules['book_file'] = 'nullable|file|mimes:pdf|max:10240';
        } else {
            $rules['book_file'] = 'nullable|file|mimes:pdf|max:10240';
        }

        // For offline or both, location fields are required
        if (in_array($request->availability_type, ['offline', 'both'])) {
            $rules['room_no'] = 'required|integer';
            $rules['rack_no'] = 'required|integer';
            $rules['shelf_no'] = 'required|integer';
            $rules['box_no'] = 'required|integer';
        }

        $request->validate($rules);

        $book->book_name = $request->book_name;
        $book->description = $request->description;
        $book->availability_type = $request->availability_type;
        $book->room_no = $request->room_no;
        $book->rack_no = $request->rack_no;
        $book->shelf_no = $request->shelf_no;
        $book->box_no = $request->box_no;

        // Handle new file upload
        if ($request->hasFile('book_file')) {
            $file = $request->file('book_file');

            // Validate that it's actually a PDF
            if ($file->getClientOriginalExtension() !== 'pdf') {
                return back()->withErrors(['book_file' => __('Only PDF files are allowed.')]);
            }

            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());

            // Delete previous file if exists
            if (!empty($book->{'book-file'})) {
                $old = $book->{'book-file'};
                if (Storage::disk('public')->exists('book_store/' . $old)) {
                    Storage::disk('public')->delete('book_store/' . $old);
                }
            }

            $file->storeAs('book_store', $filename, 'public');
            $book->{'book-file'} = $filename;
        }

        $book->updated_at = Carbon::now();
        $book->save();

        return redirect()->route('book-store.index')->with('success', __('Book successfully updated!'));
    }

    // Delete book
    public function destroy($id)
    {
        $book = BookStore::findOrFail($id);

        // Delete stored file if present
        if (!empty($book->{'book-file'})) {
            $file = $book->{'book-file'};
            if (Storage::disk('public')->exists('book_store/' . $file)) {
                Storage::disk('public')->delete('book_store/' . $file);
            }
        }

        $book->delete();

        return redirect()->route('book-store.index')->with('success', __('Book successfully deleted!'));
    }

    // View PDF file
    public function viewFile($id)
    {
        $book = BookStore::findOrFail($id);

        if (empty($book->{'book-file'})) {
            abort(404, 'File not found');
        }

        $filename = $book->{'book-file'};
        $filePath = 'book_store/' . $filename;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found');
        }

        return Storage::disk('public')->response($filePath, $filename, ['Content-Type' => 'application/pdf']);
    }

    // My books
    public function myBookStore()
    {
        $books = BookStore::where('created_by', auth()->id())->orderBy('id', 'desc')->get();
        return view('book_store.my', compact('books'));
    }

    // Archive list
    public function archiveList()
    {
        $books = BookStore::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        return view('book_store.archive', compact('books'));
    }
}
