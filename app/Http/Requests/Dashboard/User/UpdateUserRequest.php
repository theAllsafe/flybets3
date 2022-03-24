<?php

namespace App\Http\Requests\Dashboard\User;

use App\Rules\DocumentIDTypeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        if ($this->id == auth()->id())
        return true;
//        else
//            return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        , 'unique:users,national_passport_id,' . auth()->id(),
        return [
            'first_name' => ['regex:/^[A-za-z ]+$/'],
            'last_name' => ['regex:/^[A-za-z ]+$/'],
            'email' => ['nullable', 'email'],
            'national_passport_id' => [
                'required',
                'min:8', 'max:12',
                'regex:/^[a-zA-Z0-9]+$/',
                Rule::unique('users', 'national_passport_id')->ignore($this->user->id),
                new DocumentIDTypeRule($this->document_type)
//                Rule::unique('organisations', 'contact_number')->ignore($this->user->id),
            ],
            'national_passport_file_link' => ['nullable', 'file'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'not_in:0'],
            'document_type' => ['required', 'not_in:0'],
            'nationality' => ['required', 'not_in:0'],
            'mobile_number' => [
                'required',
                'numeric',
                'digits_between:6, 10',
                Rule::unique('users', 'mobile_number')->ignore($this->user->id),
                Rule::unique('organisations', 'contact_number')->ignore($this->user->id),
            ],
            'profile_complete' => ['nullable', 'boolean'],
            'is_pilot' => ['nullable', 'boolean'],
            'has_org' => ['nullable', 'boolean'],
        ];
    }

    function messages()
    {
        return[
            'national_passport_id.required' => 'The national / passport id field is required.',
        ];
    }
}
