<?php

namespace App\Enums;

enum RoomStatus: string
{
    case AVAILABLE = 'available';
    case BOOKED = 'booked';
}
