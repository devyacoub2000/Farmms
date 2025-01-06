<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::latest('id')->paginate(10);
        return view('admin.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {         
        $request->validate([
              'name_en' => 'required',
              'name_ar' => 'required',
              'body_en' => 'required',
              'body_ar' => 'required',
              'price' => 'required',
              'discount' => 'required',
              'quantity' => 'required',
              'category_id' => 'required',
              'image' => 'required|image',
        ]);

        $data = Product::create([
            'name' => '',
            'body' => '',
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        $img = $request->File('image');
        $img_name = rand().time().$img->getClientOriginalName();
        $img->move(public_path('images'), $img_name);
        $data->image()->create([
           'path' => $img_name,
        ]);

        return redirect()->route('admin.product.index')
        ->with('msg', 'Add Product Successfully')
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
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
              'name_en' => 'required',
              'name_ar' => 'required',
              'price' => 'required',
              'discount' => 'required',
              'quantity' => 'required',
              'category_id' => 'required',
        ]);

        $product->update([
            'name' => '',
            'body' => '',
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        if($request->hasFile('image')) {
            if($product->image) {
                File::delete(public_path('images/'.$product->image->path));
                $product->image()->delete();
            }
            $img = $request->File('image');
            $img_name = rand().time().$img->getClientOriginalName();
            $img->move(public_path('images'), $img_name);
            $product->image()->create([
               'path' => $img_name,
            ]);
        }

        return redirect()->route('admin.product.index')
        ->with('msg', 'Edit Product Successfully')
        ->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
         if($product->image) {
            File::delete(public_path('images/'.$product->image->path));
            $product->image()->delete();
         }
         $product->delete();
         return redirect()->route('admin.product.index')
        ->with('msg', 'Delete Product Successfully')
        ->with('type', 'danger');

           
    }
}
