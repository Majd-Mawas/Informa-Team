<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->Name,
            "by" => $this->By,
            "difficulty" => $this->difficulty,
            "type" => $this->type,
            "duration" => $this->duration,
            "num_video" => $this->num_video,
            "released_at" => $this->released_at,
            "telegram_link" => $this->telegram_link,
            "rate" => $this->rate
        ];
    }
}
