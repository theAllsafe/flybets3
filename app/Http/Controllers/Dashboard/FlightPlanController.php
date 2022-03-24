<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FlightPlan\StoreFlightPlanRequest;
use App\Models\FlightPlan;
use App\Models\Organisation;
use App\Models\UASOperator;
use App\Models\UnmannedAircraft;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FlightPlanController extends MainController
{

    function getUASOperator(Request $request)
    {
        $id = $request->id;
        return UASOperator::with('user')->find($id);
    }

    function getAircraft(Request $request)
    {
        $id = $request->id;
        return UnmannedAircraft::find($id);;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $flight_plans = FlightPlan::all();
        return view('dashboard.flight_plan.index', compact('flight_plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function create()
    {
        $unmanned_aircraft = UnmannedAircraft::where('user_id', auth()->id())->get();
        if ($unmanned_aircraft->count() > 0) {
            if (session()->get('active_operator_type') == 'o')
                $uas_operators = Organisation::find(session()->get('active_operator_id'))->uasOperators;
            else {
                $uas_operators = collect();
                $uas_operators->push(auth()->user()->uasOperator);
            }
            $countries = $this->getCountries();
            $aircrafts = UnmannedAircraft::all();
            $aircrafts_for_org = collect();
            foreach ($aircrafts as $aircraft) {
                foreach ($uas_operators as $uas_operator) {
                    if ($uas_operator->user->id == $aircraft->user_id) {
                        $aircrafts_for_org->push($aircraft);
                        break;
                    }
                }
            }
            $aircrafts = $aircrafts_for_org;
            return view('dashboard.flight_plan.create', compact(['uas_operators', 'countries', 'aircrafts']));
        }
        return redirect()->back()->with('error', [
            'title' => 'Unmanned Aircraft is not available',
            'content' => 'Please add Unmanned Aircraft before create Flight Plan.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreFlightPlanRequest $request)
    {
        
//        return $request->validated();
        $data = array_merge($request->validated(), ['lat' => 10, 'lng' => 10, 'uas_plan_id' => 0]);
        $data['map_details']=$request->map_details;
        FlightPlan::create($data);
        return redirect()->route('flight-plan.index')->with('success', [
            'title' => 'Create Flight Plan',
            'content' => 'Flight Plan has been created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param FlightPlan $flightPlan
     * @return Response
     */
    public function show(FlightPlan $flightPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FlightPlan $flightPlan
     * @return Response
     */
    public function edit(FlightPlan $flight_plan)
    {
        $uas_operators = UASOperator::with('user')->get();
        $countries = $this->getCountries();
        $aircrafts = UnmannedAircraft::all();
        $uas_operator = $flight_plan->uasOperator;
        $aircraft = $flight_plan->unmannedAircraft;
        return \view('dashboard.flight_plan.edit', compact(['flight_plan', 'uas_operators', 'countries', 'aircrafts', 'aircraft']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param FlightPlan $flightPlan
     * @return RedirectResponse
     */
    public function update(StoreFlightPlanRequest $request, FlightPlan $flightPlan)
    {
        $flightPlan->update($request->validated());
        return redirect()->back()->with('success', [
            'title' => 'Edit Flight Plan',
            'content' => 'Flight Plan has been edited successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FlightPlan $flightPlan
     * @return RedirectResponse
     */
    public function destroy(FlightPlan $flightPlan)
    {
        $flightPlan->delete();
        return redirect()->route('flight-plan.index')->with('success', [
            'title' => 'Delete Flight Plan',
            'content' => 'Flight Plan has been deleted successfully.'
        ]);
    }
}
