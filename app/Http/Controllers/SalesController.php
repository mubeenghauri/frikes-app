<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Product;
use App\Models\Item;
use App\RPrinter;
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

    public function xreport(Request $request) {
        $date = $request->input('date');

        $sales = Sales::where('date', $date)->get();

        $productsList = [];
        $total = 0;
        $discount = 0;
        foreach ($sales as $s) {
            $product = $s->products();
            $total += $s->total_amount;
            $discount += $s->discount;
            foreach ($product as $p) {
                if(array_key_exists($p->name, $productsList)) {
                    $productsList[$p->name]['quantity'] += 1;
                } else {
                    $productsList[$p->name] = [];
                    $productsList[$p->name]['quantity'] = 1;
                    $productsList[$p->name]['price'] = $p->price;
                }
            }
        }
        Log::debug($productsList);

        $items = Item::all();

        $itemsList = [];

        foreach ($items as $i) {
            $itemsList[] = [
                'name' => $i->name,
                'qty' => $i->quantity,
                'warn' => $i->warning_quantity
            ];
        }

        Log::debug($itemsList);

        $printer = new RPrinter();
        $printer->xreport($productsList, $itemsList, $total, $discount);
    }
}
