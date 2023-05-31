<?php

namespace App\Jobs\StateliteImage;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProjectProcessing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $project_id;
    protected $date_start;
    protected $date_end;
    protected $python_service_url;
    protected $prefix;

    /**
     * Create a new job instance.
     */
    public function __construct($project_id, $date_start, $date_end)
    {
        $this->project_id = $project_id;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->python_service_url = env('PYTHON_SERVICE_URL');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->prefix = '/project/processing';

        $response = Http::timeout(420)->post($this->python_service_url . $this->prefix, [
            'project_id' => $this->project_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
        ]);

        Log::info('Project procssing: ' . $response);
    }
}
