<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Appointment;
use App\Models\StaffDetail;
use App\Models\StaffAvailability;
use App\Models\Service;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /** Customers → appointments they booked */
    public function customerAppointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'customer_id');
    }

    /** Staff → appointments assigned to them */
    public function staffAppointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'staff_id');
    }

    /** Staff details */
    public function staffDetails()
    {
        return $this->hasOne(StaffDetail::class, 'user_id');
    }

    /** Availability for staff members */
    public function availability()
    {
        return $this->hasMany(StaffAvailability::class, 'staff_id');
    }

    /** Services they can perform */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'staff_services', 'staff_id', 'service_id');
    }

    public function staffServices()
    {
        return $this->hasMany(StaffService::class, 'staff_id');
    }
}
