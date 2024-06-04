<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayworkLabourItem extends Model
{
    protected $fillable = [
        'daywork_order_id',
        'labour_name',
        'date',
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
