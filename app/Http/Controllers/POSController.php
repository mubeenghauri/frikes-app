<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;
use App\Models\Sales;

// use Carbon;
use Log;

class POSController extends Controller
{
    
    public function index() {
    	$data['products'] = Product::all();
    	return view('pos', $data);
    }

    public function demoPos() {
    	return view('pos-demo-org');
    }

    public function processOrder(Request $request) {
        // print_r($request);
        try {
            Log::debug((array) $request->all());

            $items = $request->input('items');
            $total = $request->input('total');
            $discount = $request->input('discount');
    
            /**
             * TODO send data to receipt printer
             */
    
            $products = [];
    
            foreach ($items as $item) {
                Log::debug($item);
                $p = Product::where('name', $item['name'])->get()->first();
    
                $products[] = [
                    'id' => $p->id,
                    'quantity' => $item['quantity'],
                    'price' => (int) $item['price']
                ];
            }
    
            Log::debug($products);
    
            $sid = Sales::getId();
            $sale = Sales::create([
                'sale_id' => $sid,
                'total_amount' => $total,
                'discount' => $discount,
                'date' => \Carbon\Carbon::now()->toDateString()
            ]);
    
            Sales::addProducts($products, $sid);
        } catch (Exception $e) {
            Log::warning('[POSController] [processOrder] Error occoured : ', (array) $e);
            response()->json(["status" => "failure"]);
        }
        response()->json(["status" => "success"])->status(200);
    }
}
