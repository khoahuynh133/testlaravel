<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket; // Nếu có model Ticket

class TicketController extends Controller
{
    public function index()
    {
        // Nếu chưa có model Ticket, tạm thời chỉ trả view rỗng
        return view('tickets.index');
    }
}
