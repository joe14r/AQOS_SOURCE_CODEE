<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Menu::latest()->paginate(5);
  
        return view('admin.menu.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        //dd($request);
        $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'required|string',
        //'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|in:active,inactive', // Or use boolean if you prefer
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads/menu', 'public');
    }

    $menu = Menu::create([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'image' => $imagePath,
        'status' => $request->input('status'),
    ]);

    return redirect()->back()->with('success', 'Menu created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Menu::find($id);

        return view('admin.menu.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Menu::find($id);
    
        return view('admin.menu.edit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        //'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|in:active,inactive',
    ]);
        $data = Menu::find($id);

    // Image Upload
    if ($request->hasFile('image')) {
        // Optionally: delete old image
        if ($data->image && \Storage::disk('public')->exists($data->image)) {
            \Storage::disk('public')->delete($data->image);
        }
        
        $data->image = $request->file('image')->store('uploads/menu', 'public');
    }

    // Update other fields
    $data->name = $request->input('name');
    $data->price = $request->input('price');
    $data->description = $request->input('description');
    $data->status = $request->input('status');


    $data->save();

    return redirect()->back()->with('success', 'Menu updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Menu::find($id)->delete();
        return redirect()->route('menus.index')
                        ->with('success','Table deleted successfully');
    }
}
