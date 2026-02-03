<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function store(Request $request, Flight $flight)
    {
        $request->validate([
            'passenger_name' => 'required|string|max:255',
        ]);

        return DB::transaction(function () use ($request, $flight) {
            // Refresh to get latest seat count
            $flight->lockForUpdate()->find($flight->id);

            if ($flight->seats_available <= 0) {
                return response()->json([
                    'message' => 'No seats available for this flight'
                ], 422);
            }

            // Create the booking
            $booking = Booking::create([
                'flight_id' => $flight->id,
                'passenger_name' => $request->passenger_name,
                'status' => 'confirmed'
            ]);

            // Decrease seats
            $flight->decrement('seats_available');

            return response()->json([
                'message' => 'Booking successful',
                'booking' => $booking,
                'remaining_seats' => $flight->seats_available
            ], 201);
        });
    }
}
