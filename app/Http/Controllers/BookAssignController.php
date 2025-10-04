<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookAssign;
use App\Models\User;
use App\Models\BookHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BookAssignController extends Controller
{
    /**
     * Display a listing of the book assignments.
     */
    public function index(Request $request)
    {
        // if (!\Auth::user()->can('manage book assign')) {
        //     return redirect()->back()->with('error', __('Permission Denied!'));
        // }
        // $user = auth()->user();
        // return $user;
        // return $request;

        $query = BookAssign::with(['book', 'user'])->where('parent_id', parentId());

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('book_id')) {
            $query->where('book_id', $request->book_id);
        }

        $bookAssigns = $query->orderBy('id', 'desc')->get();
        $users = User::where('parent_id', parentId())->selectRaw("CONCAT(first_name, ' ', last_name) as name, id")->pluck('name', 'id');
        $books = Book::where('parent_id', parentId())->pluck('title', 'id');

        return view('book_assign.index', compact('bookAssigns', 'users', 'books'));
    }

    /**
     * Show the form for creating a new book assignment.
     */
    public function create()
    {
        if (!\Auth::user()->can('create book assign')) {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }

        $users = User::where('parent_id', parentId())->selectRaw("CONCAT(first_name, ' ', last_name) as name, id")->pluck('name', 'id');
        $books = Book::where('parent_id', parentId())->pluck('title', 'id');

        return view('book_assign.create', compact('users', 'books'));
    }

    /**
     * Store a newly created book assignment in storage.
     */
    public function store(Request $request)
    {
        if (!\Auth::user()->can('create book assign')) {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }

        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'due_date' => 'required|date',
        ]);

        $assign = BookAssign::create([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'assigned_date' => Carbon::now(),
            'due_date' => $request->due_date,
            'status' => 'assigned',
            'parent_id' => parentId(),
            'created_by' => \Auth::user()->id,
        ]);

        BookHistory::create([
            'book_id' => $assign->book_id,
            'user_id' => $assign->user_id,
            'action' => 'Assigned',
            'description' => 'Book assigned to ' . $assign->user->name,
            'parent_id' => parentId(),
        ]);

        return redirect()->route('book-assign.index')->with('success', __('Book successfully assigned!'));
    }

    /**
     * Display the specified book assignment.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $assign = BookAssign::with(['book', 'user'])->find($id);

        if (!$assign) {
            return redirect()->back()->with('error', __('Book assignment not found!'));
        }

        return view('book_assign.show', compact('assign'));
    }

    /**
     * Show the form for editing the specified book assignment.
     */
    public function edit($id)
    {
        if (!\Auth::user()->can('edit book assign')) {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }

        $id = Crypt::decrypt($id);
        $assign = BookAssign::find($id);

        if (!$assign) {
            return redirect()->back()->with('error', __('Book assignment not found!'));
        }

        $users = User::where('parent_id', parentId())->selectRaw("CONCAT(first_name, ' ', last_name) as name, id")->pluck('name', 'id');
        $books = Book::where('parent_id', parentId())->pluck('title', 'id');

        return view('book_assign.edit', compact('assign', 'users', 'books'));
    }

    /**
     * Update the specified book assignment in storage.
     */
    public function update(Request $request, $id)
    {
        if (!\Auth::user()->can('edit book assign')) {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }

        $id = Crypt::decrypt($id);
        $assign = BookAssign::find($id);

        if (!$assign) {
            return redirect()->back()->with('error', __('Book assignment not found!'));
        }

        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'due_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $assign->update([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        BookHistory::create([
            'book_id' => $assign->book_id,
            'user_id' => $assign->user_id,
            'action' => 'Updated',
            'description' => 'Assignment updated by ' . \Auth::user()->name,
            'parent_id' => parentId(),
        ]);

        return redirect()->back()->with('success', __('Book assignment successfully updated!'));
    }

    /**
     * Mark a book as returned.
     */
    public function returnBook($id)
    {
        if (!\Auth::user()->can('return book')) {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }

        $id = Crypt::decrypt($id);
        $assign = BookAssign::find($id);

        if (!$assign) {
            return redirect()->back()->with('error', __('Book assignment not found!'));
        }

        $assign->update([
            'status' => 'returned',
            'returned_date' => Carbon::now(),
        ]);

        BookHistory::create([
            'book_id' => $assign->book_id,
            'user_id' => $assign->user_id,
            'action' => 'Returned',
            'description' => 'Book returned by ' . $assign->user->name,
            'parent_id' => parentId(),
        ]);

        return redirect()->back()->with('success', __('Book successfully returned!'));
    }

    /**
     * Remove the specified book assignment from storage.
     */
    public function destroy($id)
    {
        if (!\Auth::user()->can('delete book assign')) {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }

        $id = Crypt::decrypt($id);
        $assign = BookAssign::find($id);

        if (!$assign) {
            return redirect()->back()->with('error', __('Book assignment not found!'));
        }

        $assign->delete();

        BookHistory::create([
            'book_id' => $assign->book_id,
            'user_id' => $assign->user_id,
            'action' => 'Deleted',
            'description' => 'Assignment deleted by ' . \Auth::user()->name,
            'parent_id' => parentId(),
        ]);

        return redirect()->back()->with('success', __('Book assignment successfully deleted!'));
    }

    /**
     * Display the book assignment history.
     */
    public function history()
    {
        if (!\Auth::user()->can('manage book history')) {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }

        $histories = BookHistory::where('parent_id', parentId())->orderBy('id', 'desc')->get();
        return view('book_assign.history', compact('histories'));
    }
}
