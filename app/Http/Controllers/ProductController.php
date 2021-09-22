<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;
use Log;

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
		$category = $request->input('category');

		Log::debug('add got request : ', $request->all());

		$items = Item::all();
		$dependent_items = array();

		foreach ($items as $item) {
			$n = implode(' ', explode('_', $request->input($item->name)));
			$request->input($item->name) != null 
			? $dependent_items[$item->name] =  $n
			: false;
		}

		// first create the product
		Product::create([
			'name' => $productname,
			'price' => $price,
			'category' => $category
		]);
		Log::debug("Got dependednt items : ", $dependent_items);
		// then add the items associated with the product
		Product::addItems($productname, $dependent_items);
		
		return $this->index($request, "Added Product succesfully !!");
	}

	public function getItems(Request $request) {
		$id = $request->input('productid');
		Log::debug("Got product id : $id");
		$items = Product::where('id', $id)->get()->first()->items();
		$arrayItems = [];
		foreach ($items as $i) {
			$arrayItems[] = $i->toArray();
		}

		return response()->json($arrayItems);
	}
}
