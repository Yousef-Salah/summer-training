<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'rating',
        'image_path'  
    ];

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

}
