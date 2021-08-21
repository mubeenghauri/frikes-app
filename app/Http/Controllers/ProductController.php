<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;

class ProductController extends Controller
{
	public function index(Request $request) {
		$data = ['items' => Item::all(), 'products' => Product::all() ] ;
		return view('products', $data);
	} 
}
