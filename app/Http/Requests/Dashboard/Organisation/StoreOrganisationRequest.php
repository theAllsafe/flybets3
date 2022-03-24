<?php

namespace App\Http\Requests\Dashboard\Organisation;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganisationRequest extends FormRequest
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
            'name' => 'required',
            'registration_number' => 'required',
            'email' => ['required', 'email', 'unique:users,email', 'unique:organisations,email'],
            'contact_number' => ['required', 'numeric', 'digits_between:6, 10', 'unique:organisations,contact_number,' . auth()->id(), 'unique:users,mobile_number'],
            'address' => 'required',
            'address2' => 'nullable',
            'city' => 'required',
            'postcode' => ['required', 'numeric'],
            'country' => ['required', 'not_in:null'],
            'type' => 'required',
            'is_organisation_pilot' => 'nullable',
        ];
    }
}
