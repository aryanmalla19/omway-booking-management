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
        'is_checked_out'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_days' => 'int',
        'total_price' => 'float',
        'status' => BookingStatus::class,
        'room_id' => 'int',
        'user_id' => 'int',
        'is_checked_out' => 'bool',
    ];

    protected $appends = ['total_payable_amount'];

    public function getTotalPayableAmountAttribute(): float|int
    {
        return $this->total_days * $this->room->price_per_day;
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
