<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegVillage extends Model
{
    public function reg_district()
    {
        return $this->belongsTo(RegDistrict::class, 'district_id');
    }
}
