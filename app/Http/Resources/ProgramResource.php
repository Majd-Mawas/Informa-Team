<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
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
            "name" => $this->Name,
            "released_at" => $this->Released_at,
            "telegram_link" => $this->telegram_link,
            "youtube_link" => $this->youtube_link,
            "size" => $this->size,
            "description" => $this->description,
            "category_name" => $this?->category?->id ?? null,
            "image_url" => $this->path ? asset('storage/' . $this->path) : null
        ];
    }
}
