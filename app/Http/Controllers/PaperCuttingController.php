<?php

namespace App\Http\Controllers;

use App\Models\PaperCutting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class PaperCuttingController extends Controller
{
    /**
     * Display a listing of paper cuttings.
     */
    public function index(Request $request)
    {
        $query = PaperCutting::where('parent_id', parentId());

        if ($request->has('created_date') && $request->created_date != '') {
            $query->whereDate('created_at', $request->created_date);
        }

        $paperCuttings = $query->orderBy('id', 'desc')->get();

        return view('paper_cutting.index', compact('paperCuttings'));
    }

    /**
     * Show the form for creating a new paper cutting.
     */
    public function create()
    {
        return view('paper_cutting.create');
    }

    /**
     * Store a newly created paper cutting in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paper_name' => 'required|string|max:255',
            'papercutting_file' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'room_no' => 'nullable|string|max:50',
            'rack_no' => 'nullable|string|max:50',
            'shelf_no' => 'nullable|string|max:50',
            'box_no' => 'nullable|string|max:50',
        ]);

        $paperCutting = new PaperCutting();
        $paperCutting->paper_name = $request->paper_name;
        $paperCutting->parent_id = parentId();
        $paperCutting->room_no = $request->room_no;
        $paperCutting->rack_no = $request->rack_no;
        $paperCutting->shelf_no = $request->shelf_no;
        $paperCutting->box_no = $request->box_no;
        $paperCutting->created_by = Auth::id();
        $paperCutting->user_id = Auth::id();

        // File upload
        if ($request->hasFile('papercutting_file')) {
            $file = $request->file('papercutting_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/papercutting'), $filename);
            $paperCutting->papercutting_file = $filename;
        }

        $paperCutting->save();

        return redirect()->route('paper-cutting.index')->with('success', __('Paper Cutting added successfully!'));
    }

    /**
     * Show the form for editing the specified paper cutting.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $paperCutting = PaperCutting::findOrFail($id);
        return view('paper_cutting.edit', compact('paperCutting'));
    }

    /**
     * Update the specified paper cutting in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $paperCutting = PaperCutting::findOrFail($id);

        $request->validate([
            'paper_name' => 'required|string|max:255',
            'papercutting_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'room_no' => 'nullable|string|max:50',
            'rack_no' => 'nullable|string|max:50',
            'shelf_no' => 'nullable|string|max:50',
            'box_no' => 'nullable|string|max:50',
        ]);

        $paperCutting->paper_name = $request->paper_name;
        $paperCutting->room_no = $request->room_no;
        $paperCutting->rack_no = $request->rack_no;
        $paperCutting->shelf_no = $request->shelf_no;
        $paperCutting->box_no = $request->box_no;

        // File upload
        if ($request->hasFile('papercutting_file')) {
            $file = $request->file('papercutting_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/papercutting'), $filename);
            $paperCutting->papercutting_file = $filename;
        }

        $paperCutting->save();

        return redirect()->route('paper-cutting.index')->with('success', __('Paper Cutting updated successfully!'));
    }

    /**
     * Remove the specified paper cutting from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $paperCutting = PaperCutting::findOrFail($id);

        // Delete file if exists
        if ($paperCutting->papercutting_file && file_exists(public_path('uploads/papercutting/' . $paperCutting->papercutting_file))) {
            unlink(public_path('uploads/papercutting/' . $paperCutting->papercutting_file));
        }

        $paperCutting->delete();

        return redirect()->route('paper-cutting.index')->with('success', __('Paper Cutting deleted successfully!'));
    }

    /**
     * Archive list (optional).
     */
    public function archiveList()
    {
        $archives = PaperCutting::onlyTrashed()->where('parent_id', parentId())->get();
        return view('paper_cutting.archive', compact('archives'));
    }

    /**
     * My Paper Cutting (optional).
     */
    public function myPaperCutting()
    {
        $papers = PaperCutting::where('user_id', Auth::id())->get();
        return view('paper_cutting.my', compact('papers'));
    }
}
