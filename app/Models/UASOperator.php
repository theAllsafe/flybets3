<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UASOperator extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'address2',
        'city',
        'postcode',
        'country',
        'type',
        'type_of_intended_operation', // 1: Recreational,2: Hire & Reward ,3: Both (Recreational / Hire & Reward)
        'name_of_entity_registered_with_ssm',
        'ssm_registration_number',
        'ssm_certificate',
        'certification', // -1: None, 1: RCoC
        'rcoc_type', // Basic, Module 1, Module 2
        'registration_id',
        'fly_registration_id'
    ];

    protected $table = 'uas_operators';

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function setRegistrationIdAttribute()
    {
        // Get Type of intended Operation
        $type = $this->typeOfIntendedSwitch($this->type_of_intended_operation);
//        if (request()->method() == 'PUT'){
//            $registration_id = substr($this->registration_id, 7, 7);
//            dd($registration_id);
//            $last_int_digits = str_pad($this->registration_id, 7, "0", STR_PAD_LEFT);
//            dd($last_int_digits);
//            $this->attributes['registration_id'] = 'UOP(' . $type . ')-' . $last_int_digits;
//        }else{
            // Get last registration id which should have the last registration id
            $last = UASOperator::get()->last();
            if ($last != null) {
                // Remove the start text from the number
                $registration_id = substr($last->registration_id, 7, 7);
                if (request()->method() != 'PUT')
                    // Convert text to integer and increase by one
                    $last_int = (int)$registration_id + 1;
                else
                    // When update to not change the ID
                    $last_int = $registration_id;
//                dd($last_int);
                // Make a what will be store 6 digits
                $last_int_digits = str_pad($last_int, 7, "0", STR_PAD_LEFT);
                $this->attributes['registration_id'] = 'UOP(' . $type . ')-' . $last_int_digits;
            } else {
                $this->attributes['registration_id'] = 'UOP(' . $type . ')-' . '0000001';
            }
//        }
    }

    private function typeOfIntendedSwitch($type_of_intended_operation){
            $type = 'X';
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
            return $type;
}

    function setFlyRegistrationIdAttribute($national_passport_id)
    {
//        dd($national_passport_id);
//        $s1 = substr($national_passport_id, 0, 6);
//        $s2 = substr($national_passport_id, 6, 2);
//        $s3 = substr($national_passport_id, 8, 4);
        $this->attributes['fly_registration_id'] = 'RP-' . $national_passport_id;
    }

    public function setRcocTypeAttribute($rcoc_type)
    {
        $this->attributes['rcoc_type'] = json_encode($rcoc_type);
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

    public function rpto()
    {
//        dd($this->hasOne(RPTO::class, 'uas_operator_id', 'id'));
        //,'uas_operator_id','id'
        return $this->belongsTo(RPTO::class);
    }

    function organisation()
    {
        return $this->hasMany(Organisation::class);
    }


}
