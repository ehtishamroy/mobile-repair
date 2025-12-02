<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RepairQuoteRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $orderNumber;
    public $customerName;
    public $customerEmail;
    public $customerPhone;
    public $deviceModel;
    public $issues;
    public $comments;
    public $qualityTierName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderNumber, $customerName, $customerEmail, $customerPhone, $deviceModel, $issues, $comments, $qualityTierName = null)
    {
        $this->orderNumber = $orderNumber;
        $this->customerName = $customerName;
        $this->customerEmail = $customerEmail;
        $this->customerPhone = $customerPhone;
        $this->deviceModel = $deviceModel;
        $this->issues = $issues;
        $this->comments = $comments;
        $this->qualityTierName = $qualityTierName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Quote Request Received - ' . $this->orderNumber)
            ->view('emails.repair-quote-request');
    }
}
