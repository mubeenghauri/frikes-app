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
    protected $fillable = ['name', 'quantity', 'unit_price', 'unit'];


    /**
     * Products using this item
     */
    public function products() {
    	return $this->belongsToMany(Product::class, 'items_product', 'product_id', 'id');
    }
}
