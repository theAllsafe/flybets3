<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\UASOperator\StoreUASOperatorByUserRequest;
use App\Http\Requests\Dashboard\UASOperator\UpdateUASOperatorRequest;
use App\Http\Requests\Dashboard\UASOperator\UpdateUASOperatorByUserRequest;
use App\Models\Organisation;
use App\Models\OrganisationMember;
use App\Models\RPTO;
use App\Models\UASOperator;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UASOperatorController extends MainController
{

    private $value;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function index()
    {
        if (auth()->user()->has_org && session()->get('active_operator_type') == 'o') {
//            $uas_operators = UASOperator::all();
            $uas_operators = Organisation::find(session()->get('active_operator_id'))->uasOperators;
//            $members->prepend(auth()->user()->uasOperator);
            return view('dashboard.uas_operator.index', compact('uas_operators'));
        }
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $this->value = $request->value;

        $members = UASOperator::whereHas('user', function ($query) {
                $query->where('first_name', 'like', '%'.$this->value.'%');
            })
            ->with('user')
            ->get();

        return view('dashboard.uas_operator.index', compact(['members']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function create()
    {
        if (auth()->user()->has_org) {
            $countries = $this->getCountries();
            $nationalities = $this->getNationalities();
            return view('dashboard.uas_operator.create', compact(['countries', 'nationalities']));
        }
        return redirect()->back()->with('success', [
            'title' => 'Permission denied',
            'content' => 'You can not access this until you have an organisation.',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function store(StoreUASOperatorByUserRequest $request)
    {
//        if (auth()->user()->has_org) {

        $ssm_certificate_path = null;
        $rpto_certificate_path = null;
        if ($request->has('ssm_certificate')) {
            $ssm_certificate_path = $this->storeFile($request->file('ssm_certificate'), $request->national_passport_id, 'ssm_certificate');
        }

        if ($request->has('rpto_certificate')) {
            $rpto_certificate_path = $this->storeFile($request->file('rpto_certificate'), $request->national_passport_id, 'rpto_certificate');
        }

//        $data = array_merge($request->validated(), ['registration_id', '12fly_registration_id']);

        $data = array_merge($request->validated(), [
            'password' => 'password',
            'is_pilot' => 1,
        ]);

        $user = User::create($data);

        $data = array_merge($data, [
            'user_id' => $user->id,
            'ssm_certificate' => $ssm_certificate_path,
            'rpto_certificate' => $rpto_certificate_path,
            'registration_id' => 0,
            'fly_registration_id' => $request->get('national_passport_id'),
        ]);

        $uas_operator = UASOperator::create($data);

        RPTO::create([
            'name' => $request->get('rpto_name'),
            'date_of_issuance' => $request->get('date_of_issuance'),
            'rpto_certificate' => $request->get('rpto_certificate'),
            'ua_manufacturer' => $request->get('ua_manufacturer'),
            'ua_model' => $request->get('ua_model'),
            'uas_operator_id' => $uas_operator->id
        ]);

        OrganisationMember::create([
            'organisation_id' => session()->get('active_operator_id'),
            'uas_operator_id' => $uas_operator->id,
            'status' => 'true',
        ]);

        return redirect()->route('uas-operator.index')->with('success', [
            'title' => 'Create Pilot',
            'content' => 'UAS Pilot has been created successfully.',
        ]);
//        }
//        return redirect()->back()->with('success', [
//            'title' => 'Permission denied',
//            'content' => 'You can not access this until you have an organisation.',
//        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param UASOperator $uASOperator
     * @return \Illuminate\Http\Response
     */
    public function show(UASOperator $uASOperator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UASOperator $uASOperator
     * @return RedirectResponse
     */
    public function edit($user_id)
    {
        $uas_operator = User::find($user_id)->uasOperator;
        if ($uas_operator->user->id == auth()->id()) {
            $user = $uas_operator->user;
//        $uas_operator = UASOperator::where('user_id', $user->id)->first();
            $rpto = RPTO::where('uas_operator_id', $uas_operator->id)->first();
//            dd($rpto);
            $countries = $this->getCountries();
            return view('dashboard.uas_operator.edit', compact(['user', 'countries', 'uas_operator', 'rpto']));
        }
        return redirect()->back()->with('error', [
            'title' => 'Permission Denied',
            'content' => 'You have no permissions to access this page.',
        ]);
    }

    /**
     * @throws Exception
     */
    private function randomInt($length): string
    {
        $num = '';
        while ($length != 0) {
            $num = $num . random_int(0, 9);
            $length--;
        }
        return $num;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUASOperatorequest $request
     * @param UASOperator $uASOperator
     * @return RedirectResponse
     */
    public function update(UpdateUASOperatorRequest $request, UASOperator $uas_operator)
    {
        $ssm_certificate_path = null;
        $rpto_certificate_path = null;
        $data = array();
        if ($request->has('ssm_certificate')) {
            $ssm_certificate_path = $this->storeFile($request->file('ssm_certificate'), $uas_operator->user->national_passport_id, 'ssm_certificate');
        }

        if ($request->has('rpto_certificate')) {
            $rpto_certificate_path = $this->storeFile($request->file('rpto_certificate'), $uas_operator->user->national_passport_id, 'rpto_certificate');
        }

        // Change a character that is being in a start of registration id if intended operation changed
        if ($request->get('type_of_intended_operation') != $uas_operator->type_of_intended_operation) {
//            dd('type_of_intended_operation');
            $type_of_intended_operation = $this->checkTypeOfIntendedOperation($request->get('type_of_intended_operation'), $uas_operator->registration_id);
            $data = array_merge($request->validated(), [
                'registration_id' => $type_of_intended_operation,
            ]);

        }
        $data = array_merge($data, [
            'ssm_certificate' => $ssm_certificate_path,
            'rpto_certificate' => $rpto_certificate_path,
        ]);

        $uas_operator->update($data);

        RPTO::where('uas_operator_id', $uas_operator->id)->update([
            'name' => $request->get('rpto_name'),
            'date_of_issuance' => $request->get('date_of_issuance'),
            'rpto_certificate' => $rpto_certificate_path,
            'ua_manufacturer' => $request->get('ua_manufacturer'),
            'ua_model' => $request->get('ua_model'),
            'uas_operator_id' => $uas_operator->id
        ]);

        return redirect()->back()->with('success', [
            'title' => 'Update user profile',
            'content' => 'Your profile has been updated.',
        ]);
    }

    public function editByUser(UASOperator $uas_operator)
    {
//        dd($uas_operator->user);
        $user = $uas_operator->user;
//        $uas_operator = UASOperator::where('user_id', $user->id)->first();
        $rpto = RPTO::where('uas_operator_id', $uas_operator->id)->first();
//        dd($rpto);
        $countries = $this->getCountries();
        return view('dashboard.organisation.edit-operator', compact(['user', 'countries', 'uas_operator', 'rpto']));
    }

    public function updateByUser(UpdateUASOperatorByUserRequest $request, UASOperator $uas_operator)
    {
        // Change a character that is being in a start of registration id if intended operation changed
        if ($request->get('type_of_intended_operation') != $uas_operator->type_of_intended_operation) {

            $type_of_intended_operation = $this->checkTypeOfIntendedOperation($request->get('type_of_intended_operation'), $uas_operator->registration_id);
            $data = array_merge($request->validated(), [
                'registration_id' => $type_of_intended_operation,
            ]);
            $uas_operator->update($data);

        } else {
            $uas_operator->update($request->validated());
        }

        return redirect()->route('uas-operator.index')->with('success', [
            'title' => 'Update user profile',
            'content' => 'Your profile has been updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UASOperator $uASOperator
     * @return RedirectResponse
     */
    public function destroy(UASOperator $uASOperator)
    {
        $uASOperator->delete();
        return redirect()->route('uas-operator.index')->with('success', [
            'title' => 'Delete UAS Operator',
            'content' => 'The UAS Operator has been deleted.',
        ]);
    }

    public function deleteByUser(UASOperator $uas_operator)
    {
        dd($uas_operator);
        $uas_operator->delete();
        return redirect()->route('uas-operator.index')->with('success', [
            'title' => 'Delete UAS Operator',
            'content' => 'The UAS Operator has been deleted.',
        ]);
    }

    private function checkTypeOfIntendedOperation($type_of_intended_operation, $registration_id): string
    {
        $type = '';
        switch ($type_of_intended_operation) {
            case $type_of_intended_operation == 1:
                $type = 'R';
                break;
            case $type_of_intended_operation == 2:
                $type = 'H';
                break;
            case $type_of_intended_operation == 3:
                $type = 'M';
                break;
        }
        // Remove the start text from the number
        $registration_id = substr($registration_id, 7, 7);
        // Make a what will be store 6 digits
        return 'UOP(' . $type . ')-' . $registration_id;
    }
}
