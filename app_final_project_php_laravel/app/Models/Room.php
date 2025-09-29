<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster_url',
        'floor_area',
        'type',
        'price',
        'hotel_id',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facilitie::class, 'facility_rooms', 'room_id', 'facility_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'bookings', 'room_id', 'user_id')
                    ->withPivot('id', 'started_at', 'finished_at', 'days', 'price')
                    ->withTimestamps();
    }
}
