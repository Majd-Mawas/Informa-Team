<?php

namespace App\Http\Resources\Bookings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ServicesResource;

class BookingsServicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'time' => $this->time->time,
            'user_name' => $this->user->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'service' => new ServicesResource($this->services)
        ];
    }
}
