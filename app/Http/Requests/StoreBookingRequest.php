<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_id'   => ['required', 'exists:rooms,id'],
            'check_in'  => ['required', 'date', 'after:now'],
            'check_out' => ['required', 'date', 'after:check_in'],
        ];
    }
}
