<?php

namespace App\Http\Requests\Dashboard\UASOperator;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUASOperatorRequest extends FormRequest
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
            'user_id' => 'sometimes',
            'address' => 'required',
            'address2' => 'nullable',
            'city' => 'required',
            'postcode' => ['required', 'numeric'],
            'country' => ['required', 'not_in:null'],
//            'type' => ['required', 'not_in:null'],
            'type_of_intended_operation' => ['required'],
            'name_of_entity_registered_with_ssm' => ['required_if:type_of_intended_operation, 2', 'required_if:type_of_intended_operation, 3'],
            'ssm_registration_number' => ['required_if:type_of_intended_operation, 2', 'required_if:type_of_intended_operation, 3'],
            'ssm_certificate' => ['nullable'],
            'certification' => ['required', 'not_in:null'],
            'rcoc_type' => ['required_if:certification, 1'],
            'rpto_name' => ['required_if:certification, 1'],
            'date_of_issuance' => ['required_if:certification, 1'],
            'rpto_certificate' => ['nullable'],
            'ua_manufacturer' => ['required_if:certification, 1'],
            'ua_model' => ['required_if:certification, 1'],
        ];
    }
}
