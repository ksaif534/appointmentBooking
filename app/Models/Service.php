<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'duration_minutes',
        'price',
        'is_active',
    ];

    /** Staff who can perform this service */
    public function staff()
    {
        return $this->belongsToMany(User::class, 'staff_service', 'service_id', 'staff_id');
    }

    /** Appointments booked for this service */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}

