<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use App\Models\StaffAvailability;
use App\Notifications\BookingConfirmed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Carbon\Carbon;

class BookingNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_notification_is_sent_with_ics_attachment()
    {
        Notification::fake();

        $customer = User::factory()->create();
        $staff = User::factory()->create(['role' => 'staff']);
        $service = Service::create([
            'name' => 'Test Service',
            'duration_minutes' => 60,
            'price' => 100,
            'is_active' => true,
        ]);

        // Add staff availability
        StaffAvailability::create([
            'staff_id' => $staff->id,
            'weekday' => 'mon',
            'start_time' => '09:00',
            'end_time' => '17:00',
        ]);

        $staff->staffServices()->create(['service_id' => $service->id]);

        $date = Carbon::parse('next Monday')->format('Y-m-d');

        $response = $this->actingAs($customer)->post(route('booking.store'), [
            'service_id' => $service->id,
            'staff_id' => $staff->id,
            'date' => $date,
            'start_time' => '10:00',
        ]);

        $response->assertRedirect(route('appointments.index'));

        Notification::assertSentTo(
            $customer,
            BookingConfirmed::class,
            function ($notification, $channels) use ($service, $staff, $date) {
                $mailData = $notification->toMail($notification->appointment->customer);
                
                // Check subject and content
                $this->assertEquals('Booking Confirmed: ' . $service->name, $mailData->subject);
                $this->assertStringContainsString('Your appointment for ' . $service->name . ' has been confirmed.', $mailData->introLines[0]);
                
                // Check attachment
                $this->assertCount(1, $mailData->rawAttachments);
                $attachment = $mailData->rawAttachments[0];
                $this->assertEquals('appointment.ics', $attachment['name']);
                $this->assertEquals('text/calendar', $attachment['options']['mime']);
                $this->assertStringContainsString('BEGIN:VCALENDAR', $attachment['data']);
                $this->assertStringContainsString('SUMMARY:Appointment: ' . $service->name, $attachment['data']);
                
                return true;
            }
        );
    }
}
