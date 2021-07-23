<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Auth;

class DetailController extends Controller
{
    public function index($slug)
    {
        $product = Product::with(['category','user'])->where('slug', $slug)->firstOrFail();
        return view('pages.detail', compact('product'));
    }

    public function add(Request $request, $id)
    {
        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id
        ];

        Cart::create($data);
        return redirect()->route('cart');
    }
}
