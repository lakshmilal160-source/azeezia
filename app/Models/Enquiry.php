<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'enquiry_type',
        'convention_centre_id',
        'resort_id',
        'organic_farm_id',
        'status',
        'admin_notes',
    ];
}
