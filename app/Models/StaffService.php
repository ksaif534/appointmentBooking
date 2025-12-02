<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffService extends Model
{
    use HasFactory;

    protected $table = 'staff_services';

    protected $fillable = [
        'staff_id',
        'service_id',
    ];

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
