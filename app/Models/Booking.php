<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $fillable = [
        'check_in',
        'check_out',
        'total_days',
        'total_price',
        'status',
        'room_id',
        'user_id',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_days' => 'int',
        'total_price' => 'float',
        'status' => BookingStatus::class,
        'room_id' => 'int',
        'user_id' => 'int',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
