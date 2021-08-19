<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['name', 'price'];

	/**
	 * The items that belong to this product
	 */
	public function items() {
	
    	return $this->belongsToMany(Item::class, 'items_product', 'item_id', 'id')
    				->withPivot('unit_consumed');
	}

	/**
	 * Get number of units of items to be consumed 
	 * by the product for a given item-id
	 */
	public function unitConsumesFor($itemid) {
		// $item = Item::find($itemid);


	}
}
