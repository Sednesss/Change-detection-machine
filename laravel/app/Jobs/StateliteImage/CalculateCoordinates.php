<?php

namespace App\Jobs\StateliteImage;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CalculateCoordinates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $satellite_image_id;
    protected $python_service_url;
    protected $prefix;

    /**
     * Create a new job instance.
     */
    public function __construct($satellite_image_id)
    {
        $this->satellite_image_id = $satellite_image_id;
        $this->python_service_url = env('PYTHON_SERVICE_URL');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->prefix = '/coordinate_calculation';

        $response = Http::timeout(420)->post($this->python_service_url . $this->prefix, [
            'satellite_image_id' => $this->satellite_image_id
        ]);

        Log::info('Coordinate calculation: ' . $response);
    }
}
