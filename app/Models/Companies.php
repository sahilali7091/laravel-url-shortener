<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Companies extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'company_name',
    ];


    public function shortUrls()
    {
        return $this->hasMany(ShortUrl::class);
    }
}