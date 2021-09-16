<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $timestamp    = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable     = [
        'email',
        'ip',
    ];
}
