<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class StaffAvailability extends Model
{
    use HasFactory;
    protected $fillable = [
        'staff_id',
        'weekday',
        'start_time',
        'end_time',
    ];

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}

