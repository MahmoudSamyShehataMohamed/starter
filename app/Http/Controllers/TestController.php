<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
class TestController extends Controller
{

    public function welcome()
    {
        $data=[];
        $data=['name d','mahmouddd'];
        return view('welcome',compact('data'));
    }


    public function landing()
    {
        return view('landing');
    }

    public function about()
    {
        return view('about');
    }

    public function getOffers()
    {
    return Offer::select('price','name')->get();

    }
    public function store()
    {
        Offer::create([
            'name'=>'offer 3',
            'price'=>'150$',
            'details'=>'it is agood offers'
        ]);

        return "inserted successfully";
    }
    public function create()
    {
        return view('offers.offers');
    }

    public function store2(Request $request){

        //validation
        $rules =[
        'name'=>'required|max:100|unique:offers,name',
        'price'=>'required|numeric',
        'details'=>'required'
        ];

        $message = [
            'name.required'=>trans('messeges.offername'),
            'name.max'=>'الاسم يجب الا يزيد عن 100 حرف',
            'name.unique'=>'الاسم يجب الا يتكرر',
            'price.required'=>'السعر مطلوووب',
            'price.numeric'=>'السعر يجب ان يكون ارقام',
            'details.required'=>'التفاصيل مطلوووب'
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->witheInputs($request->all());
        }
        //insert into DB
        Offer::create([
        'name'=> $request->name,
        'price'=>$request->price,
        'details'=>$request->details,
        ]);
        return redirect()->back()->with(['success'=>'تم الاضافه بنجاح']);





    }

}
