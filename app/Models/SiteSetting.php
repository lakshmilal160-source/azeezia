<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
      protected $fillable = [
        'setting_key',
        'setting_value',
    ];

      public static function getAllSettings(): array
    {
        return self::pluck('setting_value', 'setting_key')->toArray();
    }
}
