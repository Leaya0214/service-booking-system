<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            return Booking::with(['user', 'service'])->get();
        }

        return $request->user()->bookings()->with('service')->get();
    }

    public function store(Request $request)
    {
        if (!$request->user()->isCustomer()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after:now',
        ]);

        $service = Service::findOrFail($request->service_id);

        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'service_id' => $service->id,
            'booking_date' => $request->booking_date,
            'status' => 'confirmed',
        ]);

        return response()->json($booking, 201);
    }
}
