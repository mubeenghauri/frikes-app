<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;
use App\Models\Sales;
use App\RPrinter;
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
            $data['items'] = $items;
            $data['total'] = $total;
            $data['discount'] = $discount;
            $data['discount_per'] = $request->input('discount_percent');

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

            try{
                $printer = new RPrinter();
                
                if ($printer == false || $printer->printRecipt($data, $sid) == false) {
                    throw new \Exception("No printer found");
                } 
            } catch(\Exception $e) {
                if(env('APP_ENV' == 'production')) {
                    Log::debug("Printer error. sending error response");
                    return response("Printer Error", 500);
                }
            }

            $sale = Sales::create([
                'sale_id' => $sid,
                'total_amount' => $total,
                'discount' => $discount,
                'date' => \Carbon\Carbon::now()->toDateString()
            ]);
    
            Sales::addProducts($products, $sid);
        } catch (\Exception $e) {
            Log::warning('[POSController] [processOrder] Error occoured : ', (array) $e);
            return response()->json(["status" => "failure"])->status(500);
        }
        return response()->json(["status" => "success"])->status(200);
    }
}
