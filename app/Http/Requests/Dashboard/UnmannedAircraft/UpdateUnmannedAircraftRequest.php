<?php

namespace App\Http\Requests\Dashboard\UnmannedAircraft;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnmannedAircraftRequest extends FormRequest
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
            'description' => 'required',
            'manufacturer_name' => 'required',
            'model_name' => 'required',
            'airframe' => ['required', 'not_in:null'],
            'uas_registration_number' => 'nullable',
            'colour' => 'required',
            'markings' => 'required',
            'mtow' => ['required', 'numeric', 'min:0.1', 'max:100'], //Maximum take-off mas
            'serial_number' => 'required',
            'additional_information' => 'nullable',
        ];
    }
}
