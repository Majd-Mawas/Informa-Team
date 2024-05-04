<?php

namespace App\Http\Resources\Bookings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\WorkshopResource;

class BookingsWorkshopsResource extends JsonResource
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
            'user_name' => $this->user->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            // "workshop" => isset($this->workshop) ? new WorkshopResource($this->workshop) : null
            "workshop" => new WorkshopResource($this->workshop)
        ];
    }
}
