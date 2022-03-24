<?php

namespace App\Http\Requests\Dashboard\UASOperator;

use App\Rules\CertificateNotNone;
use App\Rules\HasFile;
use App\Rules\NotRecreational;
use Illuminate\Foundation\Http\FormRequest;

class StoreUASOperatorRequest extends FormRequest
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

            // UAS Operator
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
            'ssm_certificate' => ['required_if:type_of_intended_operation, 2', 'required_if:type_of_intended_operation, 3'],
            'certification' => ['required', 'not_in:null'],
            'rcoc_type' => ['required_if:certification, 1'],
            'rpto_name' => ['required_if:certification, 1'],
            'date_of_issuance' => ['required_if:certification, 1'],
            'rpto_certificate' => ['required_if:certification, 1'],
            'ua_manufacturer' => ['required_if:certification, 1'],
            'ua_model' => ['required_if:certification, 1'],
            'uas_operator_id' => 'nullable',
            'registration_id' => 'nullable',
            'fly_registration_id' => 'nullable',
        ];
    }

    function messages()
    {
        return [
            'country.not_in' => 'Please Select a Country',
            'rcoc_type.required_if' => 'RCoC is required',
            'name_of_entity_registered_with_ssm.required_if' => 'Name of entity registered with SSM is required',
            'ssm_registration_number.required_if' => 'SSM registration number is required',
            'ssm_certificate.required_if' => 'SSM Certificate is required',
            'rpto_name.required_if' => 'RPTO Name is required',
            'rpto_certificate.required_if' => 'Certification is required',
            'date_of_issuance.required_if' => 'Date of issuance is required',
            'ua_manufacturer.required_if' => 'UA manufacturer is required',
        ];
    }

}
