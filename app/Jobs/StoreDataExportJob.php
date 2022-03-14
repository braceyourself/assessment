<?php

namespace App\Jobs;

use App\Mail\StoreExportMail;
use App\Models\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreDataExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Store  $store;
    public        $email;
    public        $interval;
    public string $filename;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Store $model, string $email, string $interval)
    {
        $this->store = $model;
        $this->email = $email;
        $this->interval = $interval;
        $this->filename = $this->createFilename();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $csv_data = $this->retrieveCsvData();

        $this->store($csv_data);

        $this->sendEmail();
    }


    /**********************************************
     * private
     **********************************************/
    private function createFilename(): string
    {
        $timestamp = now()->timestamp;
        return "store_{$this->store->number}_export_{$this->interval}_$timestamp.csv";
    }

    private function store(string $csv_data)
    {
        return \Storage::put($this->filename, $csv_data);
    }

    private function sendEmail()
    {
        \Mail::send(
            (new StoreExportMail($this->store, $this->filename))
                ->to($this->email)
        );
    }

    private function retrieveCsvData()
    {
        return $this->store->journal()
                           ->since($this->interval)
                           ->toBase()->toCsv();
    }
}
