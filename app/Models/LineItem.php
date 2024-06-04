<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer_name',
        'item_code',
        'item_description',
        'item_qty',
        'item_rate',
        'item_total',
    ];
}
