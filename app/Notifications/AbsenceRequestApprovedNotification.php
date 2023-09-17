<?php

namespace App\Notifications;

use App\Models\AbsenceRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AbsenceRequestApprovedNotification extends Notification
{
    use Queueable;

    private AbsenceRequest $absenceRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct(AbsenceRequest $absenceRequest)
    {
        $this->absenceRequest = $absenceRequest;
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
            ->greeting('Почитувани, '.$this->absenceRequest->employee->name)
            ->line('Вашето барање за отсуство во периодот')
            ->line('од '.$this->absenceRequest->from.' до '.$this->absenceRequest->to)
            ->line('е прифатено!')
            ->salutation('Со почит, '.$this->absenceRequest->employee->company->name)
            ->subject('Барање за отсуство е прифатено');
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
