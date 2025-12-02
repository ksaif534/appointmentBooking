<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CalendarSync extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'provider',
        'external_event_id',
        'appointment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}

