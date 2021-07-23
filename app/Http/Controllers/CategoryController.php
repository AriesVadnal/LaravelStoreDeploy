<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::paginate(32);
        return view('pages.category', compact('categories','products'));
    }

    public function detail($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->first();
        $products = Product::where('categories_id', $category->id)->paginate(32);
        return view('pages.category', compact('categories','products'));
    }
}
