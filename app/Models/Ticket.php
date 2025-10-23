<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = [
        'user_id', 'showtime_id', 'total', 'booking_time', 'status'
    ];
    protected $guarded = ['ticket_id'];
    protected $primaryKey = 'ticket_id';
    protected $dates = ['created_at', 'updated_at'];
    protected $dateFormat = 'Y-m-d H:i:s';
    // Một vé thuộc về một user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    // Một vé thuộc về một suất chiếu
    public function showtime() {
        return $this->belongsTo(ShowTime::class, 'showtime_id', 'showtime_id');
    }
    // Một vé có nhiều chi tiết vé
    public function ticketItems() {
        return $this->hasMany(TicketItem::class, 'ticket_id', 'ticket_id');
    }
}
