    <?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
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
                'volunteer_name' => $this->volunteers->name ?? '',
                'program_name' => $this->programs->Name ?? '',
                'course_name' => $this->courses->Name ?? '',
                'maintenance_name' => $this->maintenances->Name ?? '',

            ];
        }
    }
