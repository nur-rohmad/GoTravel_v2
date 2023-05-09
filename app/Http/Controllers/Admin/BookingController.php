<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $booking = Booking::orderBy('created_at', 'desc')->get();

        return view('admin.booking.index', compact('booking'));
    }

    public function detail($id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return back();
        }
        return view('admin.booking.show', compact('invoice'));
    }
}
