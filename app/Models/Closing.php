<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;
use Log;

class Closing extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'closing';
    

    /**
     * Fields fillable by student
     * 
     * @var array
     */
    protected $fillable = ['date', 'total_sales', 'total_discount', 'products'];

    public static function unclosedSales() {
        return Sales::where('closing_id', null)->get(); 
    }

    /**
     * Marks sales as closed and creates a new closing
     * 
     * @param data string date of closing
     * @param total_sale string accumalated sales
     * @param total_discounts string accumalted discounts for day
     * @param prods assiciate array of product name and quantity
     */
    public static function closeUnclosed(string $date, string $total_sale, string $total_discount, string $prods) {
        $closing = Closing::create([
            'date' => $date,
            'total_sales' => $total_sale,
            'total_discount' => $total_discount,
            'products' => $prods
        ]);

        $closingId = $closing->id;
        Sales::where('closing_id', null)->update(['closing_id' => $closingId]);

        return true;
    }

    public static function byDate($date) {
        return Closing::where('date', $date )->get();
    }

}
