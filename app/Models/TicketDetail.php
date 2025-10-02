<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDetail extends Model
{
    protected $table = 'ticket_details';
    protected $fillable = [
        'ticket_id', 'seat_id', 'price',
    ];
    protected $guarded = ['ticket_detail_id'];
    protected $primaryKey = 'ticket_detail_id';
    protected $dates = ['created_at', 'updated_at'];
    protected $dateFormat = 'Y-m-d H:i:s';
    // Một chi tiết vé thuộc về một vé
    public function ticket() {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'ticket_id');
    }
    // Một chi tiết vé thuộc về một ghế
    public function seat() {
        return $this->belongsTo(Seat::class, 'seat_id', 'seat_id');
    }
}
