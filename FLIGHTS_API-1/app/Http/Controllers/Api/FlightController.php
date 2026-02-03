<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{
    // GET /api/flights
    public function index()
    {
        return response()->json(Flight::all(), 200);
    }

    // POST /api/flights
    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_number' => 'required|string|max:20',
            'origin' => 'required|string|max:100',
            'destination' => 'required|string|max:100',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'seats_available' => 'required|integer|min:0'
        ]);

        $flight = Flight::create($validated);

        return response()->json([
            'message' => 'Flight created successfully',
            'flight' => $flight
        ], 201);
    }

    // GET /api/flights/{flight}
    public function show(Flight $flight)
    {
        return response()->json($flight, 200);
    }

    // PUT/PATCH /api/flights/{flight}
    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'flight_number' => 'sometimes|string|max:20',
            'origin' => 'sometimes|string|max:100',
            'destination' => 'sometimes|string|max:100',
            'departure_time' => 'sometimes|date',
            'arrival_time' => 'sometimes|date|after:departure_time',
            'seats_available' => 'sometimes|integer|min:0'
        ]);

        $flight->update($validated);

        return response()->json([
            'message' => 'Flight updated successfully',
            'flight' => $flight
        ], 200);
    }

    // DELETE /api/flights/{flight}
    public function destroy(Flight $flight)
    {
        $flight->delete();

        return response()->json([
            'message' => 'Flight deleted successfully'
        ], 200);
    }
}
