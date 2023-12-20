<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update-bike', $this->bike);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'nullable|max:2000',
            'model' => 'nullable|max:255',
            'frame_number' => 'nullable|required_if:uploaded_to_veloeye,1|max:255',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'frame_type_id' => 'required|exists:frame_types,id',
            'condition_id' => 'required|exists:conditions,id',
            'frame_size_id' => 'nullable|exists:frame_sizes,id',
            'wheel_size_id' => 'nullable|exists:wheel_sizes,id',
            'gender_id' => 'nullable|exists:genders,id',
            'uploaded_to_veloeye' => 'boolean',
            'price' => 'required|numeric',
            'images' => 'nullable|array|min:1|max:10',
            'images.*' => 'nullable|image|max:10000|dimensions:max_width=6000,max_height=4000',
            'postcode' => 'nullable|string|max:255',
            'additional_details' => 'nullable|max:2000',
            'more_than_one_available' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'manufacturer_id.required' => 'Please select a brand',
            'type_id.required' => 'Please select a frame type',
            'condition_id.required' => 'Please select the condition of the bike',
            'images.required' => 'Please upload at least one image (and 10 at most)',
            'images.*.required' => 'Please upload at least one image (and 10 at most)',
            'images.*.max' => 'The maximum file size is 10MB',
            'frame_number.required_if' => 'Please enter the frame number if the bike has been uploaded to veloeye',
        ];
    }
}
