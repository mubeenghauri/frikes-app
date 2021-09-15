<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Product;

use DB;
use Log;
class Sales extends Model
{
    // use HasFactory;
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales';
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'sale_id';

    protected $keyType = 'string';

    /**
     * Fields fillable by student
     * 
     * @var array
     */
    protected $fillable = ['sale_id', 'total_amount', 'discount', 'date'];

    /**
     * Prefix to be used for sales id
     *
     * @var string
     */
    public static $salesIdPrefix = "S-";

    public static function getId() {
        $salecount = Sales::withTrashed()->get()->count()+1;
        return Sales::$salesIdPrefix."00".$salecount;
    }

    public function getCurrentId() {
        return $this->sale_id;
    }

    public static function addProducts(array $products, $sid) {
        $id = $sid;
        Log::debug("sale id current = ".$id);
        foreach ($products as $p) {
            DB::table('sale_product')
                ->insert([
                    'sale_id' => $id,
                    'product_id' => $p['id'],
                    'quantity' => $p['quantity'],
                    'price' => $p['price']
                ]);

            // decrement product items
            Log::debug('Got Product with id : ',$p);
            Product::where('id', $p['id'])->get()->first()->decrementItems($p['quantity']);
        }
    }

    public static function cancel(string $sid) {
        // when reverting sale
        // firstly, add the quantity of items back
        // decremented earlier while processing sale, 
        // then soft delete sale.
        $sale = Sales::where('sale_id', $sid)->get()->first();
        $products = $sale->products();

        foreach ($products as $p) {
            $p->incrementItems($p->pivot->quantity);
        }
        $sale->delete();
    }

    public static function undoCancel(string $sid) {
        // when undoing a canceled sale
        // decrement the quantity of items back
        // incremented earlier while canceling sale, 
        // then restore  sale.
        $sale = Sales::where('sale_id', $sid)->withTrashed()->get()->first();        
        $products = $sale->products();

        foreach ($products as $p) {
            $p->decrementItems($p->pivot->quantity);
        }
        $sale->restore();
    }
    

    public static function deletedSales() {
        return Sales::onlyTrashed()->get();
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'sale_product', 'sale_id', 'product_id')
    				->withPivot('price')
                    ->withPivot('quantity')
                    ->get();
    }
}
