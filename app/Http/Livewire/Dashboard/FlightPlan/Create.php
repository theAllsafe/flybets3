<?php

namespace App\Http\Livewire\Dashboard\FlightPlan;

use App\Http\Requests\Dashboard\FlightPlan\StoreFlightPlanRequest;
use App\Models\{FlightPlan, UASOperator, UnmannedAircraft, User};
use Livewire\Component;

class Create extends Component
{
    public $countries, $aircrafts, $aircraft, $uas_operators, $uas_operator, $uas_pilot, $purpose,
        $observer_mobile_number, $aircraft_id, $lat = 10, $lng = 10;
    public $description, $timezone, $vlos_cylinder_radius, $vlos_cylinder_radius_unit = 'meters',
        $start_date_time, $end_date_time, $fly_less_120m = false, $max_height, $max_height_unit = 'meters';
    public $step1 = true, $step2 = false, $step3 = false, $step4 = false;

    protected $rules = [
        'lat' => 'nullable',
        'lng' => 'nullable',
        'purpose' => 'required',
        'description' => 'required',
        'timezone' => 'required',
        'vlos_cylinder_radius' => 'required',
        'vlos_cylinder_radius_unit' => 'required',
        'max_height' => 'required',
        'max_height_unit' => 'required',
        'start_date_time' => 'required',
        'end_date_time' => 'required',
        'fly_less_120m' => 'nullable',
        'observer_mobile_number' => 'required',
        'uas_pilot' => 'required',
        'aircraft_id' => 'required',
    ];

    public function render()
    {
        $this->aircrafts = UnmannedAircraft::all();
        $this->aircraft = UnmannedAircraft::first();
        $this->aircraft_id = $this->aircraft->id;
        $this->uas_operators = UASOperator::all();
        if (!empty($this->uas_pilot)) {
            $this->user = User::find($this->uas_pilot);
        } else {
            $this->user = User::find(auth()->id());
            $this->uas_pilot = $this->user->id;
        }

        return view('livewire.dashboard.flight-plan.create');

    }

    public function submit()
    {
        $this->validate();

        $data = array_merge($this->validate(), [
            'uas_operator_id' => $this->uas_pilot,
            'unmanned_aircraft_id' => $this->aircraft->id,
        ]);

        FlightPlan::create($data);

        return redirect()->route('flight-plan.index')->with('success', [
            'title' => 'Flight Plan created',
            'content' => 'You have successfully created a new Flight Plan.'
        ]);
    }


    function next()
    {
        if ($this->step1) {
            $this->step1 = false;
            $this->step2 = true;
            $this->step3 = false;
            $this->step4 = false;
        } elseif ($this->step2) {
            $this->step1 = false;
            $this->step2 = false;
            $this->step3 = true;
            $this->step4 = false;
        } elseif ($this->step3) {
            $this->step1 = false;
            $this->step2 = false;
            $this->step3 = false;
            $this->step4 = true;
        }
    }

    function back()
    {
        if ($this->step2) {
            $this->step1 = true;
            $this->step2 = false;
            $this->step3 = false;
            $this->step4 = false;
        } elseif ($this->step3) {
            $this->step1 = false;
            $this->step2 = true;
            $this->step3 = false;
            $this->step4 = false;
        } elseif ($this->step4) {
            $this->step1 = false;
            $this->step2 = false;
            $this->step3 = true;
            $this->step4 = false;
        }
    }

    public function save()
    {

    }


//    public function mount($uas_pilot)
//    {
//        $this->user = $uas_pilot;
////        dd('Hello');
//    }


}
