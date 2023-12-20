<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'account_type' => 'required|in:' . implode(',', User::ACCOUNT_TYPES),
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'business_name' => 'nullable|max:255|required_if:account_type,' . User::BUSINESS,
            'email' => 'required|email|max:255',
            'bio' => 'nullable|max:240',
            'address_1' => 'nullable|max:255',
            'address_2' => 'nullable|max:255',
            'town' => 'nullable|max:255',
            'county' => 'nullable|max:255',
            'country' => 'nullable|max:255',
            'postcode' => 'nullable|string|max:255',
            'phone' => 'nullable|max:255',
            'facebook' => 'nullable|max:255',
            'twitter' => 'nullable|max:255',
            'instagram' => 'nullable|max:255',
            'linkedin' => 'nullable|max:255',
            'profile_photo' => 'nullable|image|max:10000|dimensions:max_width=6000,max_height=4000',
            'verification_images.*' => 'nullable|image|max:10000|dimensions:max_width=6000,max_height=4000',
        ];
    }

    public function messages()
    {
        return [
            'account_type.required' => 'Please select an account type',
            'business_name.required_if' => 'A business Name is required to switch to a Business account',
            'images.*.max' => 'The maximum file size is 10MB',
        ];
    }
}
