<?php

namespace App\Mail;

use App\Models\RepairOrder;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RepairOrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $settings;
    public $currencySymbol;

    /**
     * Create a new message instance.
     */
    public function __construct(RepairOrder $order)
    {
        // Ensure relationships are loaded
        if (!$order->relationLoaded('service')) {
            $order->load('service');
        }
        if (!$order->relationLoaded('deviceType')) {
            $order->load('deviceType');
        }
        
        $this->order = $order;
        $this->settings = Setting::first();
        $this->currencySymbol = $this->settings->currency_symbol ?? '£';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $settings = Setting::first();
        $fromAddress = env('MAIL_FROM_ADDRESS', $settings->contact_email ?? 'noreply@example.com');
        $fromName = env('MAIL_FROM_NAME', $settings->site_name ?? 'Harrow Mobiles');
        
        return new Envelope(
            from: new Address($fromAddress, $fromName),
            subject: 'Repair Order Confirmation - ' . $this->order->order_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.repair-order-confirmation',
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
