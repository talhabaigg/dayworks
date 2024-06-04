<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayworkAttachment extends Model
{
    protected $fillable = [
        'daywork_order_id',
        'file_path',
    ];

    // Define the inverse of the relationship with DayworkOrder
    public function order()
    {
        return $this->belongsTo(DayworkOrder::class, 'daywork_order_id');
    }
}
