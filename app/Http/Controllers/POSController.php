<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class POSController extends Controller
{
    
    public function index() {
    	$data['products'] = Product::all();
    	return view('pos', $data);
    }

    public function demoPos() {
    	return view('pos');
    }
}
