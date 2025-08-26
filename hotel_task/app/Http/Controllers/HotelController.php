<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'location' => 'nullable|string|min:3|alpha',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:1',
        ]);

        $query = Hotel::query();

        // location filtration
        if ($request->filled('location')) {
                                        // simple 
            $query->where('location', 'like', '%' . $validated['location'] . '%');
        }

        // Insted of this code, below is using of scope for filtering based on price

        // if ($request->filled('min_price') || $request->filled('max_price')) {
        //     $query->whereHas('rooms', function($room_query) use($request){
        //         $room_query->when($request->min_price, function($q) use ($request) {
        //             $q->where('price', '>', $request->min_price);
        //         });
                
        //         $room_query->when($request->max_price, function($q) use ($request) {
        //             $q->where('price', '<', $request->max_price);
        //         });
        //     });
        // }

        $query->filterByPriceRange($validated['min_price'] ?? null, $validated['max_price'] ?? null);

        $hotels = $query->withCount(['rooms'])->paginate(5);

        return view('hotels.index', compact('hotels'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }
}
