<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchBikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'nullable|string',
            'model' => 'nullable|string',
            'frame_number' => 'nullable|string',
            'manufacturer_id' => 'nullable|exists:manufacturers,id',
            'frame_type_id' => 'nullable|exists:frame_types,id',
            'condition_id' => 'nullable|exists:conditions,id',
            'frame_size_id' => 'nullable|exists:frame_sizes,id',
            'wheel_size_id' => 'nullable|exists:wheel_sizes,id',
            'gender_id' => 'nullable|exists:genders,id',
            'uploaded_to_veloeye' => 'nullable|boolean',
            'price' => 'nullable|numeric',
            'postcode' => 'nullable|string',
            'distance' => 'nullable|numeric',
        ];
    }
}
