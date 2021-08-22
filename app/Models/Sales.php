<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    // use HasFactory;

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
    protected $primaryKey = 'id';

    /**
     * Fields fillable by student
     * 
     * @var array
     */
    protected $fillable = ['sales_id', 'product_id', 'quantity', 'product_price', 'date'];

    /**
     * Prefix to be used for sales id
     *
     * @var string
     */
    private $salesIdPrefix = "S-";
}
