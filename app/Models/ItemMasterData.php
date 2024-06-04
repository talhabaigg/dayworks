<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMasterData extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code',
        'item_description',
        'supplier_name',
        'cost_code',
    ];
}
