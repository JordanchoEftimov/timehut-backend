<?php

namespace App\Notifications;

use App\Models\Salary;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SalaryPaidNotification extends Notification
{
    use Queueable;

    private Salary $salary;

    /**
     * Create a new notification instance.
     */
    public function __construct(Salary $salary)
    {
        $this->salary = $salary;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Почитувани, '.$this->salary->employee->user->name)
            ->line('Вашата плата за месец '.$this->salary->month_name.' изнесува')
            ->line($this->salary->net_payment)
            ->salutation('Со почит, '.$this->salary->employee->company->name)
            ->subject('Извештај за плата');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
