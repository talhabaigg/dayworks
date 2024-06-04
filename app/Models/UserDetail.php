<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'role',
        'access_level',
        'user_id',
    ];

    // Define the inverse of the relationship with DayworkOrder
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
