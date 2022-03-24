<?php

namespace App\Http\Controllers\Dashboard;

//use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FirstLogin\UpdateUserRequest;
use App\Http\Requests\Dashboard\UASOperator\StoreUASOperatorRequest;
use App\Models\Country;
use App\Models\RPTO;
use App\Models\UASOperator;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use function Livewire\str;

class FirstLoginController extends MainController
{
    function editUser()
    {
        $user = User::find(auth()->id());
        $nationalities = $this->getNationalities();
        return view('dashboard.first_login.editUser', compact(['user', 'nationalities']));
    }

    function updateUser(UpdateUserRequest $request, User $user)
    {
//        dd($request->all());
        $national_passport_file_link = $this->storeFile(
            $request->file('national_passport_file_link'),
            $request->get('national_passport_id'),
            'national_passport_certificate'
        );

        $data = array_merge($request->validated(), [
            'profile_complete' => 1,
            'national_passport_file_link' => $national_passport_file_link
        ]);
        $user->update($data);
        return redirect()->route('first-login-create-operator')->with('success', [
            'title' => 'Update user profile',
            'content' => 'Please provide additional details to complete the registration.'
        ]);
    }

    function createOperator()
    {
//        $last = UASOperator::get('registration_id')->last();
//        $last_int = (int)str_replace('UOP(I/M)-', '',$last->registration_id);
//        $input = $last_int++;
//        $input = 16;
//        dd(str_pad($input, 6, "0", STR_PAD_LEFT));

        $user = auth()->user();
        $countries = $this->getCountries();
        return view('dashboard.first_login.createPilot', compact(['user', 'countries']));
    }

    function storeOperator(StoreUASOperatorRequest $request, User $user)
    {
        $ssm_certificate_path = null;
        $rpto_certificate_path = null;
        if ($request->has('ssm_certificate'))
            $ssm_certificate_path = $this->storeFile($request->file('ssm_certificate'), $user->national_passport_id, 'ssm_certificate');
        if ($request->has('rpto_certificate'))
            $rpto_certificate_path = $this->storeFile($request->file('rpto_certificate'), $user->national_passport_id, 'rpto_certificate');
//        $data = array_merge($request->validated(), ['registration_id', '12fly_registration_id']);

        $data = array_merge($request->validated(), [
            'user_id' => $user->id,
            'ssm_certificate' => $ssm_certificate_path,
//            'rpto_certificate' => $rpto_certificate_path,
            'registration_id' => 0,
            'fly_registration_id' => $user->national_passport_id
        ]);
        $uas_operator = UASOperator::create($data);

        RPTO::create([
            'name' => $request->get('rpto_name'),
            'date_of_issuance' => $request->get('date_of_issuance'),
            'rpto_certificate' => $rpto_certificate_path,
            'ua_manufacturer' => $request->get('ua_manufacturer'),
            'ua_model' => $request->get('ua_model'),
            'uas_operator_id' => $uas_operator->id
        ]);
        $user->update(['is_pilot' => 1]);
        return redirect()->route('dashboard')->with('success', [
            'title' => 'Register UAS Operator',
            'content' => 'You have been registered as UAS Operator, your UAS Operator ID with QR Code and 1-2Fly ID have been generated.'
        ]);
    }

}
