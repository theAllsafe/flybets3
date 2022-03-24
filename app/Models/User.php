<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'document_type',
        'national_passport_id',
        'national_passport_file_link',
        'nationality',
        'date_of_birth',
        'gender',
        'mobile_number',
        'profile_complete',
        'is_pilot',
        'has_org',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords($value);
    }

    public function getGenderAttribute($gender): string
    {
        if ($gender == 1)
            return 'Male';
        elseif ($gender == 2)
            return 'Female';
        else
            return '';
    }

    function getDocumentType()
    {
        return $this->document_type == 'national_id' ? 'National ID' : 'Passport';
    }


    public function organisation()
    {
        return $this->hasOne(Organisation::class);
    }

    function hasOrganisation()
    {
        dd(Organisation::where('user_id', auth()->id())->first());
    }

    function unmannedAircraft()
    {
        return $this->hasMany(UnmannedAircraft::class);
    }

    function uasOperator()
    {
        return $this->hasOne(UASOperator::class);
    }

    function getAvatar()
    {
        return substr($this->first_name, 0, 1) . '' . substr($this->last_name, 0, 1);
    }

    function getFileName()
    {
        return str_replace('/', '', strchr($this->national_passport_file_link, '/'));
    }

    function getOrganisations()
    {
        return Organisation::where('user_id', auth()->id())->get(['id', 'name']);
    }

    function getName()
    {
        return [
            'id' => $this->id,
            'name' => $this->first_name . ' ' . $this->last_name,
            'is_user' => true
        ];
    }

}
