<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_number',
        'project_name',
        'address',
        'primary_contact_name',
        'primary_contact_email',
        'primary_contact_mobile'
        // Add more fields from the create form here
    ];
    
    public function dayworkOrderDetails()
    {
        return $this->hasMany(DayworkOrderDetail::class);
    }
}

