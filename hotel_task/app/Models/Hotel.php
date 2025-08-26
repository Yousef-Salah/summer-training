<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'rating',
        'image_path'  
    ];

    protected static function booted(): void
    {
        // this runs automaticaaly on every update and save, so I deleted the cached value, then re save it again.
        static::saving(function (Hotel $hotel) {
            $cache_key = $hotel->getCacheKey();
            Cache::forget($cache_key);

            Cache::remember($cache_key, now()->addDay(), function() use ($hotel) {
                return $hotel->load('rooms');
            });
        });

        static::deleting(function (Hotel $hotel) {
            $cache_key = $hotel->getCacheKey();
            Cache::forget($cache_key);
        });
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    /**
     * Scope a query to filter hotels by room price range.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int|null  $minPrice
     * @param  int|null  $maxPrice
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterByPriceRange(Builder $query, int|null $min_price, int|null $max_price)
    {
        return $query->whereHas('rooms', function($room_query) use($min_price, $max_price){
                    $room_query->when($min_price, function($q) use($min_price) {
                        $q->where('price', '>', $min_price);
                    });
                    
                    $room_query->when($max_price, function($q) use($max_price) {
                        $q->where('price', '<', $max_price);
                    });
                });
    }

    /**
     * customized moodel binding to cache all requested hotels for 1 day
     * 
     * @param int $value 
     * @param string|null $field
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $cache_key = 'hotel_' . $value;

        return Cache::remember($cache_key, now()->addDay(), function() use ($value) {
            return $this->with('rooms')->where('id', $value)->firstOrFail();
        });
    }

    private function getCacheKey(): string
    {
        return 'hotel_' . $this->id;
    }

}
