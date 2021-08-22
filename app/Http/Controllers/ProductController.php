<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;

class ProductController extends Controller
{
	public function index(Request $request, $msg = null) {
		$data = ['items' => Item::all(), 'products' => Product::all() ] ;
		$msg == null ? false : $data['success'] = $msg;
		return view('products', $data);
	} 

	public function add(Request $request) {
		$productname = $request->input('productname');
		$price = $request->input('price');

		$items = Item::all();
		$dependent_items = array();

		foreach ($items as $item) {
			$request->input($item->name) != null 
			? $dependent_items[$item->name] = $request->input($item->name) 
			: false;
		}

		Product::create([
			'name' => $productname,
			'price' => $price
		]);

		Product::addItems($productname, $dependent_items);
		
		return $this->index($request, "Added Product succesfully !!");
	}

}
