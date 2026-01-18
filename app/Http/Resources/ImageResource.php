<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $imageArr = explode('/',$this->image_path);
        return [
            'image_name' => end($imageArr),
            'image_path' => isset($this->image_path) ? asset('storage/'. $this->image_path) : null,
        ];
    }
}
