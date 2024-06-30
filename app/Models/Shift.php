<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'taxi_id',
        'dateStart',
        'dateFinish',
        'kmStart',
        'kmFinish',
    ];

    public function supplies()
    {
        return $this->hasMany(Supply::class);
    }

    public function taxi()
    {
        return $this->belongsTo(Taxi::class, 'taxi_id');
    }
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
