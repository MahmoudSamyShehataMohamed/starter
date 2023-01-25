<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table      = 'doctors';
    protected $fillable   = ['name','title','hospital_id','medicalfile_id','created_at','updated_at'];
    protected $hidden     = ['created_at','updated_at','pivot'];
    public    $timestamps = true;


    public function hospital()
    {
        return $this -> belongsTo('App\Models\Hospital','hospital_id','id');//forignkey of second table and primary key for the first table
    }
    }


    public function services()
    {
        return $this -> belongsToMany('App\Models\Service','doctor_service','doctor_id','service_id','id','id');// اكتب الفوريجن كى بتاع الجدول اللى انت واقف فيه اولا ثم بعد ذلك اكتب الفوريجن كى بتاع بتاع الجدول التانى ثم كذلك نفس الامر لل البريمارى كى
    }
}
