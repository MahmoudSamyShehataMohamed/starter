<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalFile extends Model
{
    protected $table = 'medicalfiles';
    protected $fillable = ['pdf','patien_id'];
    
}
