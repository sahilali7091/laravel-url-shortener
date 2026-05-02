<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Urls extends Model
{
    use HasFactory;

    protected $table = 'short_urls';

    protected $fillable = [

        'long_url',
        'short_url',
        'company_id',
        'user_id',
    ];

    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }
}