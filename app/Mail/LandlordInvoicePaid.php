<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LandlordInvoicePaid extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $owner_name;
    protected $property_name;
    protected $invoice_month;
    protected $invoice_amount;
    public function __construct($owner_name,$property_name,$invoice_month,$invoice_amount)
    {
        $this->owner_name = $owner_name;
        $this->property_name = $property_name;
        $this->invoice_month = $invoice_month;
        $this->invoice_amount = $invoice_amount;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Paid',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
             markdown: 'emails.landlord-invoice-paid-mail',with:['owner_name' => $this->owner_name,'property_name' => $this->property_name,'invoice_month' => $this->invoice_month,'invoice_amount' => $this->invoice_amount],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
