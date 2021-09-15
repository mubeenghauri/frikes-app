<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Closing;
use Log;

class ClosingController extends Controller
{
    public function index(Request $request ) {

        $closings = Closing::all('date');
        $data['closingdates'] = $closings;

        return view('closing', $data);
    }

    public function closed(Request $request) {
        $date = $request->input('date');
        $closed = Closing::where('date', $date)->get()->first();
        return response()->json($closed);
    }

    public function update(Request $request) {
        $all = json_decode($request->input('data'), true);
        Log::debug("[ClosingController::update] got request  ", (array) $all);
        $date = $all['date'];
        $totalSales = $all['total-sales'];
        $discounts = $all['total-discounts'];
        $products = (array) $all['products'];
        Closing::where('date', $date)
                ->update([ 
                    'total_sales' => $totalSales,
                    'total_discount' => $discounts,
                    'products' => $products
        ]);

        return response()->json(['status' => 'success']);
    } 

    public function unclosed() {
        $unclosed = Closing::unclosedSales();
        $salesWithProducts = array();
        foreach ($unclosed as $sale) {
            $productsForThisSale = $sale->products();
            $saleAsArray = $sale->toArray();
            $saleAsArray['products'] = $productsForThisSale;
            $salesWithProducts[] = $saleAsArray;
        }
        return response()->json($salesWithProducts);
    }

    public function close(Request $request) {
        $all = json_decode($request->input('data'), true);
        Log::debug("[ClosingController::closing] got request  ", (array) $all);
        $date = $all['date'];
        $totalSales = $all['total-sales'];
        $discounts = $all['total-discounts'];
        $products = (array) $all['products'];
        Closing::closeUnclosed($date, $totalSales, $discounts, json_encode($products));
        return response('okay')->status(200);
    }
}
