<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'staff_id',
        'service_id',
        'date',
        'start_time',
        'end_time',
        'status',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
