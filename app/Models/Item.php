<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items';
    
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
    protected $fillable = ['name', 'quantity', 'warning_quantity', 'unit_price', 'unit'];

    public static function idByName($name) {
        return Item::where(['name' => $name])->get()->first()->id;
    }

    public static function updateQuantity($itemname, $quantity) {
    	$current_quantity = Item::where('name', '=', $itemname)
    								->get()
    								->first()->quantity;
    	$newQuantity = $current_quantity + (int)$quantity;
		Item::where(['name' => $itemname] )->update(['quantity' => $newQuantity]);
    }

    public static function exists($itemname) {
    	return Item::where('name', '=', $itemname)->get()->first() != null;
    }

    /**
     * Get all items 
     */
    public static function getAll() {
    	return Items::all();
    }

    /**
     * Products using this item
     */
    public function products() {
    	return $this->belongsToMany(Product::class, 'items_product', 'item_id', 'product_id');
    }
}
