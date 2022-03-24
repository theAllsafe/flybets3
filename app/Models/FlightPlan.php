<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlightPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lat',
        'lng',
        'purpose',
        'description',
        'timezone',
        'vlos_cylinder_radius',
        'vlos_cylinder_radius_unit',
        'max_height',
        'max_height_unit',
        'start_date_time',
        'end_date_time',
        'fly_less_120m',
        'uas_operator_id',
        'observer_mobile_number',
        'additional_information',
        'status',
        'unmanned_aircraft_id',
        'uas_plan_id',
        'map_details'
    ];

    public function setUasPlanIdAttribute()
    {
        $last = FlightPlan::withTrashed()->get()->last();
        if ($last != null) {
            // Remove the start text from the number
            $uas_plan_id = substr($last->uas_plan_id, 2, 3);
            if (request()->method() != 'PUT')
                // Convert text to integer and increase by one
                $last_int = (int)$uas_plan_id + 1;
            else
                // When update to not change the ID
                $last_int = $uas_plan_id;
            // Make a what will be store 6 digits
            $last_int_digits = str_pad($last_int, 3, "0", STR_PAD_LEFT);
            $this->attributes['uas_plan_id'] = 'FP' . $last_int_digits;
        } else {
//            $this->attributes['uas_plan_id'] =
            $this->attributes['uas_plan_id'] = 'FP' . '001';
        }
    }

    function uasOperator()
    {
        return $this->belongsTo(UASOperator::class);
    }

    function unmannedAircraft()
    {
        return $this->belongsTo(UnmannedAircraft::class);
    }


}
