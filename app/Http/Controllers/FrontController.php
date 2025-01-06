<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FrontController extends Controller
{
    
    public function index() {
        return view('front.index');
    }

    public function product () {
        return view('front.product');
    }

    public function single_product ($id) {
        $item = Product::findOrFail($id);
        return view('front.single_product', compact('item'));
    }

    public function blog_list () {
        return view('front.blog_list');
    }

    public function about () {
        return view('front.about');
    }

    public function contact () {
        return view('front.contact');
    }










}
