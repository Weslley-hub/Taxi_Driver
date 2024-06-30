<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'status',
    ];

    const STATUS_AVAILABLE = 1;
    const STATUS_UNAVAILABLE = 0;

    public static function getStatuses()
    {
        return [
            self::STATUS_AVAILABLE => 'Disponível',
            self::STATUS_UNAVAILABLE => 'Indisponível',
        ];
    }

    public function getStatusLabel()
    {
        return self::getStatuses()[$this->status];
    }
}

/*
class Suplement extends Model
{
    use HasFactory;


public function supplies(){
    return $this->hasMany('App\Models\Supplies');
}
*/
