<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Product;
use Log;

class SalesController extends Controller
{
    public function index(Request $request) {
        $sales =  Sales::withTrashed()->get()->groupBy('date');
        return view('sales', compact('sales')); 
    }

    public function cancelSale(Request $request) {
        $id = $request->input('saleid');
        Log::debug("SalesController::cancelSale got id : $id");        
        Sales::where("sale_id", $id)->delete();
        return response('OK', 200);
    }

    public function undoCancelSale(Request $request) {
        $id = $request->input('saleid');
        Log::debug("SalesController::undoCancelSale got id : $id");        
        Sales::where("sale_id", $id)->restore();
        return response('OK', 200);
    }

    public function products(Request $request) {
        $id = $request->input('saleid');
        Log::debug("SalesController::products got id : $id");
        $products = Sales::where('sale_id', $id)->withTrashed()->get()->first()->products();
        $productArray = [];
        foreach ($products as $p) {
            $productArray[] = $p->toArray();
        }
        return response()->json($productArray);
    }
}
