<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Dashboard\User\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends MainController
{
    function edit()
    {
        $user = User::find(auth()->id());
        $nationalities = $this->getNationalities();
        return view('dashboard.user.edit', compact(['user', 'nationalities']));
    }

    function update(UpdateUserRequest $request, User $user)
    {
        $national_passport_file_link = '';
        $data = $request->validated();
        if ($request->hasFile('national_passport_file_link')) {
            $national_passport_file_link = $this->storeFile(
                $request->file('national_passport_file_link'),
                $request->get('national_passport_id'),
                'national_passport_id'
            );
            $data = array_merge(
                $request->validated(),
                ['national_passport_file_link' => $national_passport_file_link]
            );
        }
//        dd(strchr($user->national_passport_file_link, '/'));
        if ($request->get('national_passport_id') != $user->national_passport_id) {
            $national_passport_file_link = $request->get('national_passport_id') . '' . strchr($user->national_passport_file_link, '/');
//            dump($national_passport_file_link);
//            dd($user->national_passport_file_link);
            if ($user->national_passport_file_link != null) {
                Storage::move($user->national_passport_file_link, $national_passport_file_link);

                $data = array_merge(
                    $request->validated(),
                    ['national_passport_file_link' => $national_passport_file_link]
                );
            }
        }

        $user->update($data);
        return redirect()->back()->with('success', [
            'title' => 'Update Profile',
            'content' => 'User profile has been updated successfully.',
        ]);
    }

    function show(User $user)
    {
        return view('dashboard.user.show', compact('user'));
    }

}
