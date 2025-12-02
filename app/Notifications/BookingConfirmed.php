<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfirmed extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $appointment;

    /**
     * Create a new notification instance.
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
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
        $appointment = $this->appointment;
        $serviceName = $appointment->service->name;
        $staffName = $appointment->staff->name;
        $date = $appointment->date;
        $startTime = $appointment->start_time;
        
        $icsContent = $this->generateIcs();

        return (new MailMessage)
            ->subject('Booking Confirmed: ' . $serviceName)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your appointment for ' . $serviceName . ' has been confirmed.')
            ->line('**Date:** ' . $date)
            ->line('**Time:** ' . $startTime)
            ->line('**Staff:** ' . $staffName)
            ->action('View Appointments', route('appointments.index'))
            ->line('Thank you for booking with us!')
            ->attachData($icsContent, 'appointment.ics', [
                'mime' => 'text/calendar',
            ]);
    }

    private function generateIcs()
    {
        $appointment = $this->appointment;
        $startTime = \Carbon\Carbon::parse($appointment->date . ' ' . $appointment->start_time);
        $endTime = \Carbon\Carbon::parse($appointment->date . ' ' . $appointment->end_time);
        
        $dtStart = $startTime->format('Ymd\THis');
        $dtEnd = $endTime->format('Ymd\THis');
        $now = now()->format('Ymd\THis\Z');
        
        $summary = 'Appointment: ' . $appointment->service->name;
        $description = 'Staff: ' . $appointment->staff->name;
        
        return "BEGIN:VCALENDAR\r\n" .
            "VERSION:2.0\r\n" .
            "PRODID:-//Appointment Booking//EN\r\n" .
            "METHOD:PUBLISH\r\n" .
            "BEGIN:VEVENT\r\n" .
            "UID:" . $appointment->id . "@appointment-booking.test\r\n" .
            "DTSTAMP:" . $now . "\r\n" .
            "DTSTART:" . $dtStart . "\r\n" .
            "DTEND:" . $dtEnd . "\r\n" .
            "SUMMARY:" . $summary . "\r\n" .
            "DESCRIPTION:" . $description . "\r\n" .
            "END:VEVENT\r\n" .
            "END:VCALENDAR";
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'appointment_id' => $this->appointment->id,
            'service_id' => $this->appointment->service_id,
            'staff_id' => $this->appointment->staff_id,
        ];
    }
}
