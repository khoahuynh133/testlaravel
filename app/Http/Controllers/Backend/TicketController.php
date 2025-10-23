<?php

namespace App\Http\Controllers\Backend;

use App\Models\Ticket;
use App\Models\TicketItem;
use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use App\Http\Controllers\Controller;
use App\Models\TickeItem;
use App\Models\SeatStatus;

class TicketController extends Controller
{
    // Hiển thị danh sách vé
    public function index()
    {
        $tickets = Ticket::all();
        return view('ticket.index', compact('tickets'));
    }

    // Hiển thị form tạo vé
    public function create()
    {
        return view('ticket.create');
    }

    // Lưu vé mới
    public function store(Request $request)
    {
        $request->validate([
            'showtime_id' => 'required|integer',
            'seats' => 'required|array|min:1',
            'seats.*' => 'required|integer',
            'total' => 'required|numeric',
            'user_id' => 'required|integer',
            'payment_method' => 'nullable|string'
        ]);

        try {
            // Tạo ticket mà KHÔNG cần seat_id
            $ticket = Ticket::create([
                'user_id' => $request->user_id,
                'showtime_id' => $request->showtime_id,
                'total' => $request->total,
                'status' => 'pending',
                'payment_method' => $request->payment_method ?? 'Tại quầy'
            ]);

            foreach ($request->seats as $seat) {
                // nếu $seat chỉ là ID:
                TicketItem::create([
                    'ticket_id' => $ticket->ticket_id,
                    'seat_id' => $seat,
                    'price' =>  $request->total / count($request->seats) // đơn giản chia tổng tiền
                ]);

                SeatStatus::updateOrCreate(
                    ['seat_id' => $seat, 'showtime_id' => $request->showtime_id],
                    ['status' => 'pending']
                );
            }


            return response()->json(['success' => true, 'ticket_id' => $ticket->id]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }




    // Hiển thị form chỉnh sửa vé
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('ticket.edit', compact('ticket'));
    }

    // Cập nhật vé
    public function update(TicketRequest $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->validated());
        return redirect()->route('tickets.index')->with('success', 'Cập nhật vé thành công!');
    }

    // Xoá vé
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Xoá vé thành công!');
    }

    // Nhận vé (ví dụ: cập nhật trạng thái đã nhận)
    public function receive($id)
    {
        $ticket = Ticket::with('ticketItems')->findOrFail($id);

        $ticket->status = 'paid';
        $ticket->save();

        // Update trạng thái ghế trong seat_status
        foreach ($ticket->ticketItems as $item) {
            SeatStatus::where('seat_id', $item->seat_id)
                ->where('showtime_id', $ticket->showtime_id)
                ->update(['status' => 'booked']);
        }

        return redirect()->route('tickets.index')
            ->with('success', 'Vé đã được chuyển sang trạng thái đã thanh toán và ghế đã được đặt!');
    }
}
