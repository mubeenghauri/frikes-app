<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Closing;

class ClosingController extends Controller
{
    public function index(Request $request ) {
        return view('closing');
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
}
