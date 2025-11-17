<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email sending configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info('Testing email configuration...');
        $this->info('Mail Driver: ' . Config::get('mail.default'));
        $this->info('Mail Host: ' . Config::get('mail.mailers.smtp.host'));
        $this->info('Mail Port: ' . Config::get('mail.mailers.smtp.port'));
        $this->info('Mail Encryption: ' . Config::get('mail.mailers.smtp.encryption'));
        $this->info('Mail Username: ' . Config::get('mail.mailers.smtp.username'));
        $this->info('Mail From: ' . Config::get('mail.from.address'));
        
        try {
            Mail::raw('This is a test email from ' . config('app.name'), function ($message) use ($email) {
                $message->to($email)
                        ->subject('Test Email - ' . config('app.name'));
            });
            
            $this->info('✓ Email sent successfully to: ' . $email);
            return 0;
        } catch (\Exception $e) {
            $this->error('✗ Failed to send email: ' . $e->getMessage());
            $this->error('Error details: ' . $e->getTraceAsString());
            return 1;
        }
    }
}
