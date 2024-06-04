<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayworkOrderItem extends Model
{
    protected $fillable = [
        'daywork_order_id',
        'supplier_name',
        'item_code',
        'qty',
        'rate',
        'total',
    ];

    // Define the inverse of the relationship with DayworkOrder
    public function order()
    {
        return $this->belongsTo(DayworkOrder::class, 'daywork_order_id');
    }
}
