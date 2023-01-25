<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

use App\Models\Phone;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TestRequest;
use App\Models\Patient;
use App\Models\Country;
class RelationsController extends Controller
{
/************************************* Start one to one relation 6 hagat العاديه*******************************************************/

    public function hasOne()
    {
        //لو عاوز ترجع الريلشن  فقط(1)
        //$user = User::find(15);
        //return $user->phone;


        //لو عاوز ترجع الاتنين مع بعض(2)
        //$user = User::with('phone')->find(11);
        //return $user;


        //لو عاوز ترجعالاتنين مع بعض ولاكن +  حاجه معينه فى الريلشن خصخصة فى الريلشن(3)  //خصصخصة ب with + اقواس ويساوى
        $user = User::with(['phone' => function($q)
        {
            $q->select('code','phone','user_id');//لازم هنا تحط الفورينكى ومتنساش عملناله هييدن  فى الموديل بتاعه عشان مايظهرش معايا وهى الدااتا راجعه

        }])->find(11);
        //return $user;



        //لو عاوز ارجع حلجه جوا الريلشن فقط(4)
        //return $user -> phone -> code;


        //لو عاوز ارجع حاجه مباشرة من الداتا الاصليه بقا اللى هى مش الريلشن(5)
        return $user -> name;


    }
/************************************* End one to one relation 6 hagat  العاديه *******************************************************/





/************************************* ٍStart one to one relation 6 hagat  العكسيه *******************************************************/

    public function hasOneReverse()
    {
        //لو عاوز ترجع الريلشن  فقط(1)
        //$phone = Phone::find(1);
        //return $phone;
        //return $phone->user;


        //makeVisible()  && makeHidden()  function
        //$phone -> makeVisible('user_id');
        //$phone -> makeHidden('code');


        //لو عاوز ترجع الاتنين مع بعض(2)
        //$phone = Phone::with('user')->find(1);
        //return $phone;



        //لو عاوز ترجعالاتنين مع بعض ولاكن +  حاجه معينه فى الريلشن خصخصة فى الريلشن(3) //خصصخصة ب with + اقواس زيساوى
        /*
        $phone = Phone::with(['user' => function($q)
        {
            $q->select('id','name','mobile');//لازم هنا تحط الفورينكى ومتنساش عملناله هييدن  فى الموديل بتاعه عشان مايظهرش معايا وهى الدااتا راجعه////حاول تكتب ال اى دى هنا عشان ميحصلش معاك مشكله

        }])->find(1);
        return $phone;
        */


        //لو عاوز ارجع حاجه جوا الريلشن فقط(4)
        //$phone = Phone::with('user')->find(1);
        //return $phone->user->name;


        //لو عاوز ارجع حاجه مباشرة من الداتا الاصليه بقا اللى هى مش الريلشن(5)
        //$phone = Phone::find(1);
        //return $phone -> code;


    }
/************************************* End one to one relation 6 hagat  العكسيه *******************************************************/





/************************************* Start whereHas,wherDoesntHave and conditions *******************************************************/
    public function getUserHasPhone()
    {
        $users = User::whereHas('phone')->get();
        return $users;
    }
    public function getUserNotHasPhone()
    {

        $users = User::wherDoesntHave('phone')->get();
        return $users;
    }
    public function getUserHasPhoneWithCondition()     //خصصخصة بدون with + كوما وبدون اقواس
    {
        $users = User::whereHas('phone' , function($q){
            $q -> where('code','02');
        })->get();

        return $users;
    }

/************************************* End whereHas,wherDoesntHave and conditions *******************************************************/








/************************************* Start one to many relation 6 hagat  *******************************************************/


    public function getHospitalDoctors()
    {
        //لو عاوز ترجع الريلشن  فقط(1)
        //$hospital = Hospital::first();
        //$hospital = Hospital::where('id',1)->first();
        //$hospital = Hospital::with('doctors')->find(1);
        //return $hospital ->doctors;



        //لو عاوز ترجع الاتنين مع بعض(2)
        //$hospital = Hospital::with('doctors')->find(1);
        //return $hospital;

        //لو عاوز ترجعالاتنين مع بعض ولاكن +  حاجه معينه فى الريلشن خصخصة فى الريلشن(3)        //خصخصة ب with + اقواس ويساوى
        //$hospital = Hospital::with(['doctors' => function($q)
        //{
        //   $q -> select('name','hospital_id');//حاول تكتب ال اى دى هنا عشان ميحصلش معاك مشكله
        //}])->find(1);
        //return $hospital;



        //لو عاوز ارجع حاجه جوا الريلشن فقط(4)
        //$hospital = Hospital::with('doctors')->find(1);
        //$doctors=  $hospital -> doctors;
        //foreach($doctors as $doctor)//مش هينفع لازم اللوووووووووووووووووب عليها لانها اكتر من واحده
        //{
        //    echo $doctor -> name . ' is a doctor' . '</br>';
        //}



        //لو عاوز ارجع حاجه مباشرة من الداتا الاصليه بقا اللى هى مش الريلشن(5)
        //$hospital = Hospital::with('doctors')->find(1);
        //return $hospital -> name;


        $doctor = Doctor::find(3);
        return $doctor -> hospital ->name;


    }

/************************************* End one to many relation 6 hagat  *******************************************************/



/********************************************Start مثال عادى***********************************************************************************/
    public function hospital()
    {
        $hospitals = Hospital::all();
        return view('doctors.hospitals',compact('hospitals'));
    }

    public function doctors($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital -> doctors;
        return view('doctors.doctors',compact('doctors'));
    }

    public function delete($hospital_id)
    {
        $hospitals = Hospital::find($hospital_id);
        if(!$hospitals)
        return redirect()->back()->with(['error'=>'غير موجود حاول مرة اخرى']);

        $hospitals -> doctors() -> delete();
        $hospitals->delete();
        return redirect()->back()->with(['success' => 'تم الحذف بنجاح']);
    }

    public function showServices($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        $doctors = Doctor::all();
        $allservices = Service::all();
        $services = $doctor -> services;

        return view('doctors.services',compact('services','doctors','allservices'));
    }

    public function storeService(Request $request)
    {
        //inser in DB
        $doctor = Doctor::find($request -> doctor_id);
        if(!$doctor)
        return redirect() -> back() -> with(['error' => 'غير موجود حاول مرة اخرى']);

        //$doctor -> services() -> attach($request -> servicesIds);// دى مش بتمسح القديم بتسيب القديم وتحط عليه الجديد مع التكرار
        //$doctor -> services() -> sync($request -> servicesIds);// دى بتممسح القديم كله وبتحطلك الجديد اللى انت اختارته
        $doctor -> services() -> syncWithoutDetaching($request -> servicesIds);//دى بتحافظ على القديم وبتضفلك الجديد مع عدم النكرار
        return redirect() -> back() -> with(['success' => 'تم الاضافه بنجاح']);
    }


    public function getPatientDoctor()
    {
        $patient = Patient::find(1);
        return $patient -> doctor;
    }

    public function getContryDoctor()
    {
        $country = Country::with('doctors') -> find(1);
        //$tests = $country -> doctors;
        //foreach($tests as $test)//مش هينفع لازم اللوووووووووووووووووب عليها لانها اكتر من واحده
        //{
        //    echo $test -> name . ' is a doctor' . '</br>';
        //}
        return $country;

    }

/******************************************** End مثال عادى***********************************************************************************/






/************************************* Start whereHas,wherDoesntHave and conditions *******************************************************/

    public function hospitalsHasDoctors()
    {
        $hospitals = Hospital::whereHas('doctors')->get();
        return $hospitals;
    }

    public function hospitalsHasDoctorsMale()
    {

        $hospitals = Hospital::whereHas('doctors' , function($q){  //خصصخصة بدون with + كوما وبدون اقواس
            $q -> where('gender', 1);
        })->get();


        //خصخصة ب with  + اقواس ويساوى
        //لاحظ الفرق بين الاتنين دى wherHas , ودى  ,with relation
        //لو عاوز ترجع الاتنين مع بعض ولاكن +  حاجه معينه فى الريلشن خصخصة فى الريلشن(3)
        //$hospital = Hospital::with(['doctors' => function($q)
        //{
        //   $q -> select('name','hospital_id');//حاول تكتب ال اى دى هنا عشان ميحصلش معاك مشكله
        //}])->find(1);
        //return $hospital;



        return $hospitals;
    }

    public function hospitalsHasNoDoctors()
    {
        $hospitals = Hospital::whereDoesntHave('doctors')->get();
        return $hospitals;
    }
/************************************* End whereHas,wherDoesntHave and conditions *******************************************************/





/************************************* start many to many relation  6 hagat *******************************************************/

    public function getDoctorServices()
    {
        //لو عاوز ترجع الريلشن  فقط(1)
        //$doctor = Doctor::find(3);
        //return $doctor -> services;


        //لو عاوز ترجع الاتنين مع بعض(2)
        //$doctor = Doctor::with('services') -> find(3);
        //return $doctor;

        //لو عاوز ترجعالاتنين مع بعض ولاكن +  حاجه معينه فى الريلشن خصخصة فى الريلشن(3)
        //$doctors = Doctor::with(['services' => function($q)
        //{
        //    $q -> select('name');
        //}]) -> find(3);
        //return $doctors;



        //لو عاوز ارجع حاجه جوا الريلشن فقط(4)
        $doctor = Doctor::with('services')->find(3);
        $services = $doctor ->services;//مش هينفع لازم اللوووووووووووووووووب عليها لانها اكتر من واحده
        foreach($services as $service)
        {
            echo $service -> name  . '</br>';
        }

        //لو عاوز ارجع حاجه مباشرة من الداتا الاصليه بقا اللى هى مش الريلشن(5)
        //$doctor = Doctor::with('services')->find(3);
        //return $doctor ->name;

    }


    public function getServicesDoctor()
    {
        //اعمل الست حاجات بردو
        $service = Service::find(1);
        return $service -> doctors;
    }
/************************************* End   many to many relation 6 hagat  *******************************************************/


}


