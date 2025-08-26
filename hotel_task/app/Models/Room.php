<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Room extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        // re-cache the hotel data after updating room data
        static::saving(function (Room $room) {
            $cache_key = $room->getCacheKey($room);
            Cache::forget($cache_key);

            Cache::remember($cache_key, now()->addDay(), function() use ($room) {
                return $room->hotel->load('rooms');
            });
        });

        // re-cache after deleting
        static::deleting(function (Room $room) {
            $cache_key = $room->getCacheKey($room);
            Cache::forget($cache_key);
        });
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function getCacheKey(Room $room)
    {
        return 'hotel_' . $room->hotel_id;
    }
}
