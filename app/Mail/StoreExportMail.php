<?php

namespace App\Mail;

use App\Models\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StoreExportMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public        $export_path;
    private array $data;
    private Store $store;
    private       $filename;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Store $store, $filename)
    {
        $this->store = $store;
        $this->filename = $filename;
        $this->queue = 'mail';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.store-data-export', [
            'store'    => $this->store,
            'filename' => $this->filename,
        ])->attach(\Storage::path($this->filename));
    }

}
