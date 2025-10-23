<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatStatus extends Model
{
    protected $table = 'seat_status';
    protected $fillable = [
        'seat_id', 'showtime_id', 'status','user_id'
    ];
    protected $guarded = ['seat_status_id'];
    protected $primaryKey = 'seat_status_id';
    protected $dates = ['created_at', 'updated_at'];
    protected $dateFormat = 'Y-m-d H:i:s';
    // Một trạng thái ghế thuộc về một ghế
    public function seat() {
        return $this->belongsTo(Seat::class, 'seat_id', 'seat_id');
    }
    // Một trạng thái ghế thuộc về một suất chiếu
    public function showtime() {
        return $this->belongsTo(ShowTime::class, 'showtime_id', 'showtime_id');
    }
    // Một trạng thái ghế thuộc về một user
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
