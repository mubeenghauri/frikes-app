<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Product extends Model
{
    // use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fields fillable by student
     * 
     * @var array
     */
    protected $fillable = ['name', 'price', 'category'];

    // public static function used_item		

    /**
     * Add Dependent items into pivot table
     *
     * @param string product name
     * @param array | null dependent items 
     */
    public static function addItems($pname, $di) {
    	if($di != null || count($di) != 0 ) {
            $product = Product::where(['name' => $pname])->get()->first();
            // remove any previously associated items
            $product->items()->detach();
    		$productid = $product->id;
    		foreach($di as $itemName => $unit_consumed) {
    			DB::table('items_product')->insert([
    				'item_id' => Item::idByName($itemName),
    				'product_id' => $productid,
    				'unit_consumed' => $unit_consumed
    			]);
    		}
    	}
    }

    /**
     * Decrement quantity for items
     * associated with this product
     */
    public function decrementItems($quan) {
        $items = $this->items()->get();
        
        foreach ($items as $item) {
            $itemid = $item->pivot->item_id;
            $unit_consumed = (float) $item->pivot->unit_consumed;
            $r = Item::where('id', $itemid)->decrement('quantity', $unit_consumed * $quan);
        }
        return true;
    }

    /**
     * Increement quantity for items
     * associated with this product
     */
    public function incrementItems($quan) {
        $items = $this->items()->get();
        
        foreach ($items as $item) {
            $itemid = $item->pivot->item_id;
            $unit_consumed = (float) $item->pivot->unit_consumed;
            $r = Item::where('id', $itemid)->increment('quantity', $unit_consumed * $quan);

        }
        return true;
    }

	/**
	 * The items that belong to this product
	 */
	public function items() {
	
    	return $this->belongsToMany(Item::class, 'items_product', 'product_id', 'item_id')
    				->withPivot('unit_consumed');
                    // ->get();
	}


	/**
	 * The items that belong to this product
	 */
	public function sales() {
	
    	return $this->belongsToMany(Sale::class, 'sale_product', 'product_id', 'sale_id')
    				->withPivot('quantity')
    				->withPivot('price');
	}


	/**
	 * Get number of units of items to be consumed 
	 * by the product for a given item-id
	 */
	public function unitConsumesFor($itemid) {
		// $item = Item::find($itemid);


	}
}
