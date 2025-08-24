<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $changes;

    public function __construct($order, $changes)
    {
        $this->order = $order;
        $this->changes = $changes; // Array of updated fields
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Order Has Been Updated - juipowerbd.com',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.orders.updated',
            with: [
                'url' => route('my-orders.show', $this->order),
                'order' => $this->order,
                'changes' => $this->changes,
                'courier_name' => $this->order->shipping_method,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
