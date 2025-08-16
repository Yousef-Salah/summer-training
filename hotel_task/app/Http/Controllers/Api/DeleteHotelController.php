<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class DeleteHotelController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
    public function __invoke(string $id)
    {
        $hotel = Hotel::findOrFail($id);

        // Since Images are links, we don't have to build a logic to delete those link
        // if there is a real images stored in server, I would go with one of these:
        // 1. Model Events to delete images before deleting the hotel
        // 2. Build Service to handle all actions/interaction for hotls
        // 3. Add images ifo to table to delete them latteron, when server consumption is low, like delete images at midnight.
        // 4. Or, I may not delete the images and hotel, I may be soft delete them to benefit them on the future. 

        $hotel->rooms()->delete();

        $hotel->delete();

        return response()->json(['messages' => 'Hotel Deleted Successfully.'], 200);
    }
}
