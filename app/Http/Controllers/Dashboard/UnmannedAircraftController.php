<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UnmannedAircraft\StoreUnmannedAircraftRequest;
use App\Http\Requests\Dashboard\UnmannedAircraft\UpdateUnmannedAircraftRequest;
use App\Models\UASOperator;
use App\Models\UnmannedAircraft;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UnmannedAircraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function index()
    {
        $unmanned_aircrafts = UnmannedAircraft::where('user_id', auth()->id())->get();
        return view('dashboard.unmanned_aircraft.index', compact('unmanned_aircrafts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.unmanned_aircraft.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUnmannedAircraftRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUnmannedAircraftRequest $request)
    {
//        dd($request->get('colour'));
        $data = array_merge($request->validated(), [
            'user_id' => auth()->id(),
        ]);
        UnmannedAircraft::create($data);
        return redirect()->route('unmanned-aircraft.index')->with('success', [
            'title' => 'Unmanned Aircraft create',
            'content' => 'Unmanned Aircraft has been created successfully.'
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\UnmannedAircraft $unmannedAircraft
     * @return \Illuminate\Http\Response
     */
    public function show(UnmannedAircraft $unmannedAircraft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UnmannedAircraft $unmanned_aircraft
     * @return Factory|Application|View
     */
    public function edit(UnmannedAircraft $unmanned_aircraft)
    {
        return view('dashboard.unmanned_aircraft.edit', compact('unmanned_aircraft'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UnmannedAircraft $unmannedAircraft
     * @return RedirectResponse
     */
    public function update(UpdateUnmannedAircraftRequest $request, UnmannedAircraft $unmannedAircraft)
    {
        $unmannedAircraft->update($request->validated());
        return redirect()->route('unmanned-aircraft.index')->with('success', [
            'title' => 'Unmanned Aircraft create',
            'content' => 'Unmanned Aircraft has been created successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\UnmannedAircraft $unmannedAircraft
     * @return RedirectResponse
     */
    public function destroy(UnmannedAircraft $unmannedAircraft)
    {
        $unmannedAircraft->delete();
        return redirect()->route('unmanned-aircraft.index')->with('success', [
            'title' => 'Unmanned Aircraft Delete',
            'content' => 'Unmanned Aircraft has been removed successfully.'
        ]);
    }

    function search(Request $request)
    {
        $value = $request->value;
        $unmanned_aircrafts = UnmannedAircraft::where('user_id', auth()->id())
            ->where('manufacturer_name', 'like', '%' . $value . '%')
            ->orwhere('description', 'like', '%' . $value . '%')->get();
        return view('dashboard.unmanned_aircraft.index', compact('unmanned_aircrafts'));
    }

}
