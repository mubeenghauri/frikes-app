<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Product;

class SalesController extends Controller
{
    public function index(Request $request) {
        $data['sales'] = Sales::all(); 
    }
}
