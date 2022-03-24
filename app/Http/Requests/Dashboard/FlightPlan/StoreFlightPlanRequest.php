<?php

namespace App\Http\Requests\Dashboard\FlightPlan;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlightPlanRequest extends FormRequest
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
            'lat' => 'nullable',
            'lng' => 'nullable',
            'purpose' => 'required',
            'description' => 'required',
            'timezone' => 'required',
            'vlos_cylinder_radius' => 'required',
            'vlos_cylinder_radius_unit' => 'required',
            'max_height' => 'required',
            'max_height_unit' => 'required',
            'start_date_time' => ['required', 'date','before:end_date_time'],
            'end_date_time' => ['required', 'date', 'after:start_date_time'],
            'additional_information' => 'nullable',
            'fly_less_120m' => 'nullable',
            'observer_mobile_number' => 'nullable',
            'uas_operator_id' => 'required',
            'unmanned_aircraft_id' => 'required',
            'uas_plan_id' => 'nullable'
        ];
    }
}
