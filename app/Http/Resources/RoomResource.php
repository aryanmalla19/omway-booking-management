<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'room_type' => ucwords($this->room_type),
            'price_per_day' => $this->price_per_day,
            'description' => $this->description,
            'status' => $this->status,
            'amenities' => $this->whenLoaded('amenities', fn() => AmenityResource::collection($this->amenities)),
            'images' => $this->whenLoaded('images', fn() => ImageResource::collection($this->images)),
        ];
    }
}
