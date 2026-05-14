<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_logo',
        'favicon',
        'support_email',
        'support_phone',
        'store_address',
        'currency_symbol',
        'tax_rate',
        'facebook_url',
        'instagram_url'
    ];
}
