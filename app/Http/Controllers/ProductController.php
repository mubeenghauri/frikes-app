<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;
use Redirect;
use Log;


class ProductController extends Controller
{
	public function index($msg = null) {
		$data = ['items' => Item::all(), 'products' => Product::all() ] ;
		$msg == null ? false : $data['success'] = $msg;
		return view('products', $data);
	} 

	public function update(Request $request) {
		// dd($request->all());
		$price = $request->input('price');
		$pname = $request->input('pid');

		$items = $request->all();
		// sanatize input, only keep items
		unset($items['price']);
		unset($items['pid']);
		unset($items['_token']);

		// dd($items, $pname, $price);

		$items = Item::all();
		$dependent_items = array();

		foreach ($items as $item) {
			$n = implode(' ', explode('_', $request->input($item->name)));
			$request->input($item->name) != null 
			? $dependent_items[$item->name] =  $n
			: false;
		}


		Log::debug("[UpdateProduct] Got dependednt items : ", $dependent_items);
		// then add the items associated with the product
		Product::addItems($pname, $dependent_items);
		
		return redirect('/products')->with('success' , "Updated");
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

		return redirect('/products')->with('success' , "Added Product succesfully !!");		
	}

	function delete(Request $request) {
		// dd($request->all());
		$pid = $request->input('pid');

		$product = Product::where('id', $pid)->get()->first();
		$product->items()->detach();
		$product->delete();
		return redirect('/products')->with('success' , "Deleted Product succesfully !!");		
	}

	public function getItems(Request $request) {
		$id = $request->input('productid');
		Log::debug("Got product id : $id");
		$items = Product::where('id', $id)->get()->first()->items()->get();
		$arrayItems = [];
		foreach ($items as $i) {
			$arrayItems[] = $i->toArray();
		}

		return response()->json($arrayItems);
	}
}
