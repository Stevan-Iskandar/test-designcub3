<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegDistrict extends Model
{
    public function reg_village()
    {
        return $this->hasMany(RegVillage::class, 'district_id');
    }

    public function reg_regency()
    {
        return $this->belongsTo(RegRegency::class, 'regency_id');
    }
}
