<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ProgramCollection;
use App\Http\Resources\CourseCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
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
            'user_name' => $this->beneficiaries->name ?? '',
            // 'volunteer_name' => $this->volunteers->name ?? '',
            'programs' => new ProgramCollection($this->programs) ?? '',
            'courses' => new CourseCollection($this->courses) ?? '',
            'maintenance_name' => $this->maintenances->Name ?? '',

        ];
    }
}
