<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate_eur',
        'rate_usd',
        'rate_gbp',
        'rate_aud',
        'date',
    ];
}
