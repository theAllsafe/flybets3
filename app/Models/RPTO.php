<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RPTO extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_of_issuance',
        'rpto_certificate',
        'ua_manufacturer',
        'ua_model',
        'uas_operator_id'
    ];

    function uasOperator()
    {
//        ,'uas_operator_id','id'
        dd($this->belongsTo(UASOperator::class));
    }

}
