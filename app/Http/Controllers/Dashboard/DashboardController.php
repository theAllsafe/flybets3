<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{Organisation, UASOperator, UnmannedAircraft};
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{
    function index()
    {
        
        $active_uas_operations = 0;
        $completed_uas_operations = 0;
        $unmanned_aircraft_number = UnmannedAircraft::all()->where('user_id', auth()->id())->count();
        $uas_pilots_number = 1;
        if (session()->get('active_operator_type') == 'o')
            $uas_pilots_number = Organisation::find(session()->get('active_operator_id'))->uasOperators->count();
        return view('dashboard.index', compact([
            'active_uas_operations',
            'completed_uas_operations',
            'unmanned_aircraft_number',
            'uas_pilots_number',
        ]));
    }


    function switchProfile($id)
    {
        $new_profile = profiles();
        if ($new_profile[$id]['is_user']) {
            changeProfileValues('i', auth()->id());
        } else {
            $id = $new_profile[$id]['id'];
            $organisation = Organisation::find($id);
            changeProfileValues('o', $organisation->id);
        }

        return redirect()->route('dashboard')->with('success', [
            'title' => 'Switch Profile',
            'content' => 'Profile switched successfully.',
        ]);
    }

}
