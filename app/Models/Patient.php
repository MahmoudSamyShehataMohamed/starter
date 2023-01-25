<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';
    protected $fillable = ['name','age'];

    public function doctor()
    {
        return $this -> hasOneThrough('App\Models\Doctor','App\Models\MedicalFile','patient_id','medicalfile_id','id','id');//بنحط الجدول التالت ثم الجدول الثانى اللى هو جدول من خلال ثم الفوريجن كى بتاع التالت ثم الفوريجن كى بتاع التانى  ثم ال اى دى بتاع التالت ثم ال اى دى بتاع التالت

    }
}
