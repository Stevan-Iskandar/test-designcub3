<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegProvince extends Model
{
    public function reg_regency()
    {
        return $this->hasMany(RegRegency::class, 'province_id');
    }
}
