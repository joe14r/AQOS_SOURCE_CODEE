<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $data = Table::latest()->paginate(5);
  
        return view('admin.table.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.table.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request);
        $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        //'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|in:active,inactive', // Or use boolean if you prefer
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads/table', 'public');
    }

    $post = Table::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'image' => $imagePath,
        'status' => $request->input('status'),
    ]);

    return redirect()->back()->with('success', 'Table created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Table::find($id);

        $url = config('app.url').'/menu-table/'.$data->tid;
        $qrCode = QrCode::size(300)->generate($url);
        $qr_code= 'data:image/png;base64,' . base64_encode($qrCode);

        return view('admin.table.show',compact('data','qr_code'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Table::find($id);
    
        return view('admin.table.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        //'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|in:active,inactive',
    ]);
        $table = Table::find($id);

    // Image Upload
    if ($request->hasFile('image')) {
        // Optionally: delete old image
        if ($table->image && \Storage::disk('public')->exists($table->image)) {
            \Storage::disk('public')->delete($table->image);
        }
        
        $table->image = $request->file('image')->store('uploads/table', 'public');
    }

    // Update other fields
    $table->title = $request->input('title');
    $table->description = $request->input('description');
    $table->status = $request->input('status');


    $table->save();

    return redirect()->back()->with('success', 'Table updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Table::find($id)->delete();
        return redirect()->route('tables.index')
                        ->with('success','Table deleted successfully');
    }
}
