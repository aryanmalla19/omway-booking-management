<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoomStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Models\Amenity;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::latest()->paginate(10);

        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $amenities = Amenity::where('status', true)->get();

        return view('rooms.create', compact('amenities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        try {
            $data = $request->validated();

            $room = Room::create([
                'room_type' => $data['room_type'],
                'description' => $data['description'] ?? null,
                'price_per_day' => $data['price_per_day'],
                'status' => RoomStatus::AVAILABLE,
            ]);

            if ($request->has('images')) {
                foreach ($data['images'] as $image) {
                    $filePath = $image->store('images/rooms', 'public');
                    $room->images()->create([
                        'image_path' => $filePath,
                    ]);
                }
            }

            $room->amenities()->sync($data['amenities'] ?? []);

            return redirect()->route('rooms.index')->with('success', 'Successfully created new Room');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $amenities = Amenity::where('status', true)->get();

        $room->loadMissing(['images', 'amenities']);

        return view('rooms.edit', compact('room', 'amenities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoomRequest $request, Room $room)
    {
        try {
            $data = $request->validated();

            $room->update([
                'room_type' => $data['room_type'],
                'description' => $data['description'] ?? null,
                'price_per_day' => $data['price_per_day'],
                'status' => RoomStatus::AVAILABLE,
            ]);

            if ($request->has('images')) {
                foreach ($data['images'] as $image) {
                    $filePath = $image->store('images/rooms', 'public');
                    $room->images()->create([
                        'image_path' => $filePath,
                    ]);
                }
            }

            $room->amenities()->sync($data['amenities'] ?? []);

            return redirect()->route('rooms.index')->with('success', 'Successfully created new Room');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        try {
            $room->delete();

            return redirect()->back()->with('success', 'Successfully deleted Room');
        } catch (\Throwable $throwable) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
