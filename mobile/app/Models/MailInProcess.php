<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailInProcess extends Model
{
    protected $table = 'mail_in_process';

    protected $fillable = [
        'title',
        'description',
        'process_title',
        'process_description',
        'timeline_title',
        'timeline_description',
    ];

    /**
     * Get the mail-in process content (singleton)
     */
    public static function getContent()
    {
        return static::first() ?? static::create([
            'title' => 'Mail-in service',
            'description' => 'Thank you for selecting our mail-in repair service. This is our most widely accessible service and ideal for customers who do not live near our service centre.',
            'process_title' => 'What\'s the process?',
            'process_description' => 'Place the device inside the pack and drop into your local post office. Once we receive your device, we will diagnose the issue, complete the repair, and mail your device back to you.',
            'timeline_title' => 'How long will it take?',
            'timeline_description' => 'Usually, your device will be returned to you within 2-3 business days from the point we receive your device at our central service centre. In certain circumstances, depending on the nature of the issue and parts availability, your repair may take longer than this. In these circumstances we will contact you so that you remain up to date on how your repair is progressing.',
        ]);
    }
}
