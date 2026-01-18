<?php

namespace App\Http\Requests;

use App\Enums\RoomType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_type' => ['required'], // new Enum(RoomType::class) or , 'in:deluxe,single,double' if fixed
            'description' => 'nullable|string',
            'price_per_day' => 'required|numeric|min:0',
            'images.*' => 'nullable|file|image|mimes:jpg,png,webp,jpeg|max:2048',
        ];
    }
}
