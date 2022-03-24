<?php

namespace App\Http\Requests\Dashboard\UASOperator;

use App\Rules\DocumentIDTypeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUASOperatorByUserRequest extends FormRequest
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
            // User Validation
            'first_name' => ['required', 'regex:/^[A-za-z ]+$/'],
            'last_name' => ['required', 'regex:/^[A-za-z ]+$/'],
            'email' => ['required', 'email',
                'unique:users,email', 'unique:organisations,email'
            ],
            'national_passport_id' => ['required', 'min:8', 'max:12',
                Rule::unique('users', 'national_passport_id'),
                new DocumentIDTypeRule($this->document_type),
                'regex:/^[a-zA-Z0-9]+$/'],
            'national_passport_file_link' => ['required', 'file'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'not_in:0'],
            'mobile_number' => ['required', 'numeric', 'digits_between:6, 10',
                'unique:users,mobile_number', 'unique:organisations,contact_number'
            ],
            'profile_complete' => ['nullable', 'boolean'],
            'is_pilot' => ['nullable', 'boolean'],
            'has_org' => ['nullable', 'boolean'],
            // UAS Operator
            'user_id' => 'sometimes',
            'address' => 'required',
            'address2' => 'nullable',
            'city' => 'required',
            'postcode' => ['required', 'numeric'],
            'country' => ['required', 'not_in:null'],
            'certification' => ['required', 'not_in:null'],
            'rcoc_type' => ['required_if:certification, 1'],
            'rpto_name' => ['required_if:certification, 1'],
            'date_of_issuance' => ['required_if:certification, 1'],
            'rpto_certificate' => ['required_if:certification, 1'],
            'ua_manufacturer' => ['required_if:certification, 1'],
            'ua_model' => ['required_if:certification, 1'],
            'registration_id' => 'nullable',
            'fly_registration_id' => 'nullable',
        ];
    }
}
