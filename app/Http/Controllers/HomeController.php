<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class HomeController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('galleries')->get();
        return view('pages.home', compact('categories','products'));
    }
}
