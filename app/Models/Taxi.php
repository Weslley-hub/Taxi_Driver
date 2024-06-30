<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
class Taxi extends Model
{
    use HasFactory;
}
 */

class Taxi extends Model
{
    protected $fillable = ['plate', 'kmStart', 'kmActual', 'status'];
}
