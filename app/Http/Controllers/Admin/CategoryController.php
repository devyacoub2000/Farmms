<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::latest('id')->paginate();
        return view('admin.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'name_en' => 'required',
           'name_ar' => 'required',
        ]);
        $name = [
           'en' => $request->name_en,
           'ar' => $request->name_ar,
        ]; 
        Category::create([
          'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
        ]);
        return redirect()->route('admin.category.index')
        ->with('msg', 'Add Category Suucessfully')
        ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
         $request->validate([
           'name_en' => 'required',
           'name_ar' => 'required',
        ]);
        $name = [
           'en' => $request->name_en,
           'ar' => $request->name_ar,
        ];
        $category->update([
          'name' => json_encode($name, JSON_UNESCAPED_UNICODE),
        ]);
        return redirect()->route('admin.category.index')
        ->with('msg', 'Edit Category Suucessfully')
        ->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')
        ->with('msg', 'Delete Category Suucessfully')
        ->with('type', 'danger');

    }
}




