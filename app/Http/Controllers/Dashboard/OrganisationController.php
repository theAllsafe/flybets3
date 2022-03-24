<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\Dashboard\Organisation\InvitationMail;
use App\Models\Country;
use App\Models\Organisation;
use App\Models\OrganisationMember;
use App\Models\UASOperator;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Dashboard\Organisation\{SendUserInvitationRequest,
    StoreOrganisationRequest,
    UpdateOrganisationRequest
};

class OrganisationController extends MainController
{

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        if (auth()->user()->has_org) {
            $members = Organisation::find(session()->get('active_operator_id'))->uasOperators;
            return view('dashboard.organisation.users', compact('members'));
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function create()
    {
        $organisation_count = Organisation::where('user_id', auth()->id())->count();
        if ($organisation_count < 2) {
            $countries = $this->getCountries();
            $organisation_types = [
                'Sole proprietorship',
                'Partnership',
                'Private limited company',
                'Public limited company',
                'Unlimited companies',
                'Foreign company',
                'Limited liability partnership',
                'Government Agency',
                'Non-Governmental Organisation (NGO)',
            ];
            return view('dashboard.organisation.create', compact(['countries', 'organisation_types']));
        }
        return redirect()->route('organisation.index')->with('error', [
            'title' => 'Can not create more',
            'content' => 'You can not create any extra organisations.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreOrganisationRequest $request)
    {
        $data = array_merge($request->validated(), ['user_id' => auth()->id()]);
        $organisation = Organisation::create($data);
        User::where('id', auth()->id())->update(['has_org' => true]);
        OrganisationMember::create([
            'organisation_id' => $organisation->id,
            'uas_operator_id' => auth()->id(),
            'status' => 'active',
            'is_org_owner' => true,
        ]);


        changeProfileValues('o', $organisation->id);

        return redirect()->route('organisation.edit')->with('success', [
            'title' => 'Create Organisation',
            'content' => 'Organisation has been created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Organisation $organisation
     * @return \Illuminate\Http\Response
     */
    public function show(Organisation $organisation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Organisation $organisation
     * @return Application|Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function edit()
    {
        if (auth()->user()->has_org) {
            $organisation_types = [
                'Sole proprietorship',
                'Partnership',
                'Private limited company',
                'Public limited company',
                'Unlimited companies',
                'Foreign company',
                'Limited liability partnership',
                'Government Agency',
                'Non-Governmental Organisation (NGO)',
            ];
            $organisation = Organisation::where('user_id', auth()->id())->first();
            $countries = $this->getCountries();
            return view('dashboard.organisation.edit', compact(['organisation', 'countries', 'organisation_types']));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrganisationRequest $request
     * @param Organisation $organisation
     * @return RedirectResponse
     */
    public function update(UpdateOrganisationRequest $request, Organisation $organisation)
    {
        if (auth()->user()->has_org) {
            $organisation->update($request->validated());
            return redirect()->route('organisation.index')->with('success', [
                'title' => 'Update Organisation',
                'content' => 'Organisation has been updated successfully.'
            ]);
        }
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Organisation $organisation
     * @return RedirectResponse
     */
    public function destroy(Organisation $organisation)
    {
        if (auth()->user()->has_org) {
            $organisation->delete();
            return redirect()->route('organisation.index')->with('success', [
                'title' => 'Delete Organisation',
                'content' => 'Organisation has been deleted successfully.',
            ]);
        }
        return redirect()->back();
    }

    public function invitePage()
    {
        return view('dashboard.organisation.invite');
    }

    function invite(SendUserInvitationRequest $request)
    {
        Mail::to($request->get('email'))->send(new InvitationMail());

        return $request->get('email');
//        return redirect()->route('organisation.index')->with('success', [
//            'title' => 'Invite User',
//            'content' => 'Email has been send successfully.',
//        ]);
    }

    public function deleteByUser(UASOperator $uas_operator)
    {
        $uas_operator->delete();
        return redirect()->route('organisation.index')->with('success', [
            'title' => 'Delete User',
            'content' => 'The User has been deleted.',
        ]);
    }

}

