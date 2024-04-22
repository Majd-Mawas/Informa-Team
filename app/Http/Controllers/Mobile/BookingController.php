<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingCollection;
use App\Http\Resources\Bookings\BookingsVolunteersCollection;
use App\Http\Resources\Bookings\BookingsVolunteersResource;
use App\Http\Resources\Bookings\BookingsServicesCollection;
use App\Http\Resources\Bookings\BookingsServicesResource;
use App\Http\Resources\Bookings\BookingsWorkshopsCollection;
use App\Http\Resources\Bookings\BookingsWorkshopsResource;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BookingCollection(Booking::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $booking = new Booking;

            $booking->user_id = $request->user_id;
            $booking->description = $request->description;

            if (isset($request->workshop_id)) {
                $booking->workshop_id = $request->workshop_id;
                $booking->is_volunteer = 0;
            } else if ($request->time_id) {
                $booking->time_id = $request->time_id;
                $booking->is_volunteer = 0;
                $requestedService = '';
                $ServiceType = '';
                if (isset($request->program_id)) {
                    $requestedService = $request->program_id;
                    $ServiceType = 'Programs';
                }
                if (isset($request->maintenance_id)) {
                    $requestedService = $request->maintenance_id;
                    $ServiceType = 'Maintenance';
                }
                if (isset($request->course_id)) {
                    $requestedService = $request->course_id;
                    $ServiceType = 'Course';
                }

                $service_id = $this->createService($request->user_id, $requestedService, $ServiceType);
                $booking->service_id = $service_id;
            } else {
                $booking->is_volunteer = 1;
            }

            $booking->save();
            return new BookingResource($booking);
        } catch (\Exception $e) {
            // abort(500);
            return $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        if (isset($booking)) {

            if (isset($booking->workshop_id)) {
                return response()->json([
                    'type' => "Workshop Booking",
                    'data' => new BookingsWorkshopsResource($booking)
                ]);
            } else if (isset($booking->service_id)) {
                return response()->json([
                    'type' => "Services Booking",
                    'data' => new BookingsServicesResource($booking)
                ]);
                // return new BookingsServicesResource($booking);
            } elseif (isset($booking->is_volunteer)) {
                // return new BookingsVolunteersResource($booking);
                return response()->json([
                    'type' => "Volunteers Booking",
                    'data' => new BookingsVolunteersResource($booking)
                ]);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        try {
            $booking->update($request->all());
            return new BookingResource($booking);
        } catch (\Exception $e) {
            abort(500);
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        try {

            $booking->delete();

            return response()->json(["data" => "Booking Deleted Successfully"]);
        } catch (\Exception $e) {
            abort(500);
            return $e;
        }
    }

    public function createService($user_id, $requestedService, $ServiceType)
    {
        $service = new Service;

        $service->Beneficiarie_id = $user_id;

        switch ($ServiceType) {
            case 'Programs':
                $service->Program_id = $requestedService;
                break;
            case 'Maintenance':
                $service->Maintenance_id = $requestedService;
                break;
            case 'Course':
                $service->Course_id = $requestedService;
                break;
        }

        $service->started_at = now();
        $service->ended_at = now();
        $service->save();

        return $service->id;
    }

    public function workshops()
    {
        return new BookingsWorkshopsCollection(Booking::whereNotNull('workshop_id')->get());
    }
    public function services()
    {
        return new BookingsServicesCollection(Booking::whereNotNull('service_id')->get());
    }
    public function volunteers()
    {
        return new BookingsVolunteersCollection(Booking::where('is_volunteer', 1)->get());
    }
}
