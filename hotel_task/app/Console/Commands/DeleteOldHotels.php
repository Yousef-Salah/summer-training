<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\DeleteHotelController;
use App\Models\Hotel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class DeleteOldHotels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotels:delete-old-hotels {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Old Hotels Data';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $hotel_id = $this->argument('id');
        
        if (!$hotel_id) {
            $this->error('Please enter a hotel ID.');
            return 1;
        }
        
        $controller = new DeleteHotelController();
        $response = $controller->__invoke($hotel_id);
        
        if ($response->status() === 200) {
            $this->info("Hotel with id {$hotel_id} is successfully deleted.");
        } else {
            $this->error("Failed to delete hotel with ID {$hotel_id}.");
        }
    }
}
