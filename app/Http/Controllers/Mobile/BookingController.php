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
use Illuminate\Support\Facades\Log;

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
            $type = '';
            if (isset($request->type) && $request->type == "workshops") {
                $booking->workshop_id = $request->workshop_id;
                $booking->is_volunteer = 0;
                $type = 'workshop';
            } else if (isset($request->type) && $request->type == "services") {
                $booking->is_volunteer = 0;
                $requestedService = [];
                $type = 'service';

                // return $request;


                if (isset($request->programs_id)) {
                    $requestedService['Programs'] = $request->programs_id;
                }

                if (isset($request->maintenance_id)) {
                    $booking->time = $request->time;
                    $requestedService['Maintenances'] = $request->maintenance_id;
                }

                if (isset($request->courses_id)) {
                    $requestedService['Courses'] = $request->courses_id;
                }
                // return $requestedService;
                $service_id = $this->createService($request->user_id, $requestedService);
                $booking->service_id = $service_id;
                // return $service_id;
            } else if (isset($request->type) && $request->type == "volunteers") {
                $booking->is_volunteer = 1;
                $type = 'volunteer';
            }

            $booking->save();
            switch ($type) {
                case 'workshop':
                    return new BookingsWorkshopsResource($booking);

                case 'service':

                    return new BookingsServicesResource($booking);
                case 'volunteer':

                    return new BookingsVolunteersResource($booking);
                default:
                    return "Informa Team";
            }
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
                // return response()->json([
                //     'data' => new BookingsWorkshopsResource($booking)
                // ]);
                return new BookingsWorkshopsResource($booking);
            } else if (isset($booking->service_id)) {
                return response()->json([
                    'data' => new BookingsServicesResource($booking)
                ]);
            } elseif (isset($booking->is_volunteer)) {
                return response()->json([
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

            if ($booking->services) {
                $booking->services->delete();
            }

            return response()->json(["data" => "Booking Deleted Successfully"]);
        } catch (\Exception $e) {
            abort(500);
            return $e;
        }
    }

    public function createService($user_id, $requestedService)
    {

        try {


            $service = new Service;

            $service->Beneficiarie_id = $user_id;
            $service->started_at = now();
            $service->ended_at = now();
            $service->save();

            foreach ($requestedService as $key => $value) {
                if ($key == 'Programs') {
                    foreach ($value as $entity) {
                        $service->programs()->attach($entity['id']);
                    }
                }

                if ($key == 'Maintenances') {
                    $service->Maintenance_id = $value;
                }

                if ($key == 'Courses') {
                    foreach ($value as $entity) {
                        $service->courses()->attach($entity['id']);
                    }
                    // $service->Course_id = $value;
                }
            }

            $service->save();

            return $service->id;
        } catch (\Exception $th) {
            throw $th;
        }
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
