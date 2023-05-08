<?php

namespace App\Models;

use App\Events\ChirpCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    use HasFactory;

    // Mass assignment protection: only allow for "message" propery (https://laravel.com/docs/eloquent#mass-assignment).
    protected $fillable = [
        'message'
    ];

    protected $dispatchesEvents = [
        'created' => ChirpCreated::class // Dispatch the ChirpCreated event when a new Chirp is created ( with the method create() which inserts it in the database ).
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
