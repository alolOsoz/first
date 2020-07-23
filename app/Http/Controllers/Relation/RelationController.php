<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Mobile;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    // one to one relation
    public function hasone()
    {

        $user = User::with(['phone' => function ($q) {
            $q->select('code', 'phone', 'user_id');
        }])->find(6);


        return response()->json($user);

    }

    public function hasonereverse()
    {
        $phone = Mobile::with(['user' => function ($q) {
            $q->select('id', 'name', 'age');
        }])->find(1);
        $phone->makeVisible(['user_id']);
        return $phone;

    }

    public function getuserphone()
    {
        return User::whereHas('phone')->get();

    }

    public function getusernophone()
    {
        return User::whereDoesntHave('phone')->get();

    }

    public function getuserphonecondition()
    {
        return User::whereHas('phone', function ($q) {
            $q->where('code', '02');
        })->get();
    }

############################## one many relation###########################
    public function hasonemany()
    {
        $hospital = Hospital::with('doctors')->find(1);

//        $doctors = $hospital->doctors;
//        foreach ($doctors as $doctor){
//            echo $doctor ->name .' '.$doctor ->title.'<br>';
//        }
        $doctor = Doctor::find(3);
        return $doctor->hospital;
        // return $hospital->doctors;
    }

    public function hospitals()
    {
        $hospitals = Hospital::select('id', 'name', 'address')->get();
        return view('doctors.hospitals', compact('hospitals'));
    }

    public function doctors($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital->doctors;
        return view('doctors.doctors', compact('doctors'));
    }

    public function hospitalsHasDoctor()
    {
        $hospitals = Hospital::whereHas('doctors')->get();
        return view('doctors.hospitals', compact('hospitals'));
    }

    public function hospitalsHasDoctorMale()
    {
        $hospitals = Hospital::with('doctors')->whereHas('doctors', function ($q) {
            $q->where('gender', 1);
        })->get();
        return view('doctors.hospitals', compact('hospitals'));

    }

    public function hospitalsNotHasDoctor()
    {
        $hospitals = Hospital::whereDoesntHave('doctors')->get();
        return view('doctors.hospitals', compact('hospitals'));

    }

    public function delete($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);
        if (!$hospital) {
            return abort('code');
        }
        $hospital->doctors()->delete();
        $hospital->delete();
        return redirect()->route('hospital.all');

    }

    public function getDoctorService()
    {
        return $doctor = Doctor::with('services')->find(5);
        //return $doctor->services;
    }

    public function getServiceDoctor()
    {
        return $doctors = Service::with(['doctors' => function ($q) {
            $q->select('doctors.id', 'name', 'title');
        }])->find(1);
    }

    public function getDoctorServiceById($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        $services = $doctor->services;
        $doctors = Doctor::select('id', 'name')->get();
        $allservices = Service::select('id', 'name')->get();
        return view('doctors.services', compact('allservices', 'doctors', 'services'));
    }

    public function saveServiceDoctor(Request $request)
    {
        $doctor = Doctor::find($request->doctor_id);

        //$doctor->services()->attach($request->services_id);// insert in many to many
        // $doctor->services()->sync($request->services_id); //for updating
        $doctor->services()->syncWithoutDetaching($request->services_id);

        return redirect()->back()->with(['sucess' => __('messages.sucess')]);


    }

    public function getPatientDoctor()
    {
        $patient = Patient::find(1);
        return $patient->doctor;
    }

    public function getCountryDoctor()
    {
        return $country = Country::with('doctors')->find(1);

    }

    public function getCountryHospital()
    {
        return Country::with('hospitals')->find(1);
    }


    public function getdoctor()
    {
        return  $doctors = Doctor::select('id', 'name', 'gender')->get();
//        if (isset($doctors) && $doctors->count() > 0)
//            foreach ($doctors as $doctor) {
//                $doctor->gender = $doctor->gender == 1 ? 'Male' : 'Female';
//
//            }
//
//        return $doctors;
    }
}
