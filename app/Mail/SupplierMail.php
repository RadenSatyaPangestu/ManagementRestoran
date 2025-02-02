<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Supplier;

class SupplierMail extends Mailable
{
    use Queueable, SerializesModels;

    public $supplier;
    public $messageContent;

    public function __construct($supplier, $messageContent)
    {
        $this->supplier = $supplier;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Pesan dari ' . config('mail.from.name'))
                    ->view('emails.supplier_email')
                    ->with([
                        'supplier' => $this->supplier,
                        'messageContent' => $this->messageContent,
                    ]);
    }
}
