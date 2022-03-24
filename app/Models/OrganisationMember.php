<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisationMember extends Model
{
    use HasFactory;

    protected $table = 'organisation_members';

    protected $fillable = [
        'organisation_id',
        'uas_operator_id',
        'status',
        'is_org_owner',
    ];

//    function members()
//    {
//        return $this->hasMany(UASOperator::class, 'id', 'uas_operator_id');
//    }

}
