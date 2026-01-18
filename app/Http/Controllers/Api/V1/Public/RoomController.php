<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Public;

use App\Enums\RoomStatus;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\RoomResource;
use App\Models\Room;

class RoomController extends ApiController
{
    public function index()
    {
        try {
            $rooms = Room::with('images')
                ->where('status', RoomStatus::AVAILABLE)
                ->paginate(10);

            return $this->success(RoomResource::collection($rooms), 'Successfully Fetched Room Details');
        } catch (\Throwable $throwable) {
            return $this->error();
        }
    }

    public function show(Room $room)
    {
        try {
            $room->loadMissing(['images', 'amenities']);

            return $this->success(new RoomResource($room), 'Successfully Fetched Single Room Detail');
        } catch (\Throwable $throwable) {
            return $this->error();
        }
    }
}
