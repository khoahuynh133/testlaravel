<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $fillable = ['name', 'theater_id'];
    protected $guarded = ['room_id'];
    protected $primaryKey = 'room_id';
    protected $dates = ['created_at', 'updated_at'];
    protected $dateFormat = 'Y-m-d H:i:s';

    // Một phòng thuộc về một rạp
    public function theater()
    {
        return $this->belongsTo(Theater::class, 'theater_id', 'theater_id');
    }

    // Một phòng có nhiều ghế
    public function seats()
    {
        return $this->hasMany(Seat::class, 'room_id', 'room_id');
    }

    // Một phòng có nhiều suất chiếu
    public function showtimes()
    {
        return $this->hasMany(ShowTime::class, 'room_id', 'room_id');
    }
}
