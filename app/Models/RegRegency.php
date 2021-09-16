<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegRegency extends Model
{
    protected $table = 'reg_regencies';

    public function reg_district()
    {
        return $this->hasMany(RegDistrict::class, 'regency_id');
    }

    public function reg_province()
    {
        return $this->belongsTo(RegProvince::class, 'province_id');
    }
}
