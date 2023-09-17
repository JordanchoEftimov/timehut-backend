<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShiftResource extends JsonResource
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
            'day' => $this->day,
            'date' => $this->start_at->format('d/m/Y'),
            'startTime' => $this->start_at->format('H:i'),
            'endTime' => $this->end_at->format('H:i'),
            'duration' => $this->duration,
        ];
    }
}
