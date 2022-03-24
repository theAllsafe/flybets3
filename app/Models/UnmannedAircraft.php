<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnmannedAircraft extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'manufacturer_name',
        'model_name',
        'airframe',
        'uas_registration_number',
        'colour',
        'markings',
        'mtow', //Maximum take-off mas
        'serial_number',
        'additional_information',
        'user_id'
    ];

    protected $table = 'unmanned_aircrafts';

    function user()
    {
        return  $this->belongsTo(User::class);
    }


}
