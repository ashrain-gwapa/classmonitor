<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Override the default verification email layout safely
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            // Generate a random 6-digit code and save it temporarily in the session cache
            $code = rand(100000, 999999);
            session(['email_verification_code' => $code]);

            return (new MailMessage)
                ->subject('ClassMonitor Verification Code')
                ->greeting('Hello, ' . $notifiable->name . '!')
                ->line('Your account registration is almost complete.')
                ->line('Please enter the 6-digit verification code below directly on your laptop screen:')
                ->line('**' . $code . '**') // 🌟 Fixed: Uses Markdown for clean bold text formatting inside line()
                ->line('This code is temporary and will expire soon.');
        });
    }
}