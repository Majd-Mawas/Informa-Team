<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkshopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "Date" => $this->Date,
            "title" => $this->title,
            "description" => $this->description,
            "ended_at" => $this->ended_at,
            "image_url" => $this->path ? asset('storage/' . $this->path) : null
        ];
    }
}
