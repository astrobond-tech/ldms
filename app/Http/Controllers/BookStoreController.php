<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookStore;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class BookStoreController extends Controller
{
    // Display all books
    public function index()
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
        $request->validate([
            'name' => 'required|string|max:255',
            'room_no' => 'nullable|string|max:50',
            'rack_no' => 'nullable|string|max:50',
            'shelf_no' => 'nullable|string|max:50',
            'box_no' => 'nullable|string|max:50',
        ]);

        $book = new BookStore();
        $book->name = $request->name;
        $book->room_no = $request->room_no;
        $book->rack_no = $request->rack_no;
        $book->shelf_no = $request->shelf_no;
        $book->box_no = $request->box_no;
        $book->created_by = auth()->id();
        $book->save();

        return redirect()->route('book-store.index')->with('success', __('Book successfully created!'));
    }

    // Show edit form
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $book = BookStore::findOrFail($id);
        return view('book_store.edit', compact('book'));
    }

    // Update book
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $book = BookStore::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'room_no' => 'nullable|string|max:50',
            'rack_no' => 'nullable|string|max:50',
            'shelf_no' => 'nullable|string|max:50',
            'box_no' => 'nullable|string|max:50',
        ]);

        $book->update([
            'name' => $request->name,
            'room_no' => $request->room_no,
            'rack_no' => $request->rack_no,
            'shelf_no' => $request->shelf_no,
            'box_no' => $request->box_no,
        ]);

        return redirect()->route('book-store.index')->with('success', __('Book successfully updated!'));
    }

    // Delete book
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $book = BookStore::findOrFail($id);
        $book->delete();

        return redirect()->route('book-store.index')->with('success', __('Book successfully deleted!'));
    }

    // My books (optional)
    public function myBookStore()
    {
        $books = BookStore::where('created_by', auth()->id())->orderBy('id', 'desc')->get();
        return view('book_store.my', compact('books'));
    }

    // Archive list (optional)
    public function archiveList()
    {
        $books = BookStore::where('status', 'archived')->orderBy('id', 'desc')->get();
        return view('book_store.archive', compact('books'));
    }
}
