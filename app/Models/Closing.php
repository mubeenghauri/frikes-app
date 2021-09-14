<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;

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

    public static function byDate($date) {
        return Closing::where('date', $date )->get();
    }

}
