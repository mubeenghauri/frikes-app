<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    
    /**
     * Load the main items page
     */
    public function index(Request $request) {
		$data = ['items' => Item::all()];
		return view('items', $data);
    }

    public function add(Request $request) {
    	$itemName = $request->input('itemname');
    	$quantity = $request->input('quantity');
    	$unit = $request->input('unit');
    	$msg = 'Something went wrong';
    	// check to see if item exists
    	if( Item::exists($itemName) ) {
    		// update quantity
    		Item::updateQuantity($itemName, $quantity);
    		$msg = "Updated Item succesfully !!";
    	}
    	else {
    		Item::create([
    			'name' => $itemName,
    			'quantity' => $quantity,
    			'unit' => $unit
    		]);
    		$msg = "Added Item succesfully !!";

    	}
		return view('items', [ 'items' => Item::all(), 'success' => $msg]);

    }
}
