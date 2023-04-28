<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chirp extends Model
{
    use HasFactory;

    // Mass assignment protection: only allow for "message" propery (https://laravel.com/docs/eloquent#mass-assignment).
    protected $fillable = [
        'message'
    ];
}
