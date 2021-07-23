<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\ProductGallery;
use App\Category;
use Auth;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries','category'])
                    ->where('users_id', Auth::user()->id)->get();
        return view('pages.dashboard-products', compact('products'));
    }

    public function details($id)
    {
        $product = Product::with(['category','galleries','user'])->findOrFail($id);
        $categories = Category::all();
        return view('pages.dashboard-products-details', compact('product','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.dashboard-products-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
             'name' => 'required|string|max:255',
             'users_id' => 'required|exists:users,id',
             'categories_id' => 'required|exists:categories,id',
             'price' => 'required|integer',
             'description' => 'required'
        ]); 

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photos')->store('assets/product','public')
        ];
        ProductGallery::create($gallery);
        return redirect()->route('dashboard-product');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'users_id' => 'required|exists:users,id',
            'categories_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'description' => 'required'
       ]); 

       $data = $request->all();
       $item = Product::findOrFail($id);
       $data['slug'] = Str::slug($request->name);
       $item->update($data);
       return redirect()->route('dashboard-products-details', $id);
    }

    public function galleryUpload(Request $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product','public');
        ProductGallery::create($data);
        return redirect()->route('dashboard-products-details', $request->products_id);
    }

    public function galleryDelete($id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();
        return redirect()->route('dashboard-products-details', $item->products_id);
    }
}
