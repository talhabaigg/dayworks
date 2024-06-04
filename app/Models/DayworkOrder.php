<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayworkOrder extends Model
{
    protected $fillable = [
        'daywork_order_date',
        'issued_by',
        'project_id',
        'daywork_ref_no',
        'description',
        'daywork_order_status',
    ];

    // Define the one-to-many relationship with DayworkOrderItem
    public function items()
    {
        return $this->hasMany(DayworkOrderItem::class, 'daywork_order_id');
    }

    public function labourItems()
    {
        return $this->hasMany(DayworkLabourItem::class, 'daywork_order_id');
    }
    public function attachments()
    {
        return $this->hasMany(DayworkAttachment::class, 'daywork_order_id');
    }

    public function signatures()
    {
        return $this->hasMany(DayworkSignature::class, 'daywork_order_id');
    }
}
