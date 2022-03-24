<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'registration_number',
        'email',
        'contact_number',
        'address',
        'address2',
        'city',
        'postcode',
        'country',
        'type',
        'is_organisation_pilot',
        'user_id'
    ];

    function setIsOrganisationPilotAttribute($is_organisation_pilot)
    {
        if ($is_organisation_pilot == 'on')
            $this->attributes['is_organisation_pilot'] = true;
        else
            $this->attributes['is_organisation_pilot'] = false;

    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function uasOperators()
    {
        return $this->hasManyThrough(UASOperator::class, OrganisationMember::class, 'organisation_id', 'id');
    }

}
