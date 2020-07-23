<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $fillable = ['name', 'title', 'hospital_id', 'medical_id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    public function hospital()
    {
        return $this->belongsTo('App\Models\Hospital', 'hospital_id');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'doctor_service', 'doctor_id', 'service_id', 'id', 'id');

    }
// acessors
    public function getGenderAttribute($val)
    {
        return $val== 1 ? 'Male' : 'Female';
    }

    //mutators in offer

}
