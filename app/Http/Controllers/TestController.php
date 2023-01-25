<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OfferRequest;
use LaravelLocalization;
use App\Traits\UploadfileTrait;

class TestController extends Controller
{
    use UploadfileTrait;

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
    public function create()
    {
        return view('offers.create');
    }

    public function store(OfferRequest $request){

    $filename = $this->saveFile($request->file,'uploads/offers');

      //insert into DB
      Offer::create([
        'file'       => $filename,
        'name_ar'    => $request->name_ar,
        'name_en'    => $request->name_en,
        'details_ar' => $request->details_ar,
        'details_en' => $request->details_en,
        'price'      => $request->price,
        ]);



        return redirect()->back()->with(['success'=>'تم الاضافه بنجاح']);

    }



    public function index()
    {

        /*
        $offers = Offer::get();
        $offers = Offer::all();
        */
        /*
        $offers = Offer::select(
            'id',
            'price',
            'name_' .LaravelLocalization::setLocale().' as name',//name_ar as name or name_en as name //LaravelLocalization::getCurrentLocale()
            'details_'.LaravelLocalization::setLocale().' as details'//details_ar as details   or details_en as details //LaravelLocalization::getCurrentLocale()
            )->get();
        */


        //start pagination
        $offers = Offer::select(
            'id',
            'price',
            'name_' .LaravelLocalization::setLocale().' as name',//name_ar as name or name_en as name //LaravelLocalization::getCurrentLocale()
            'details_'.LaravelLocalization::setLocale().' as details'//details_ar as details   or details_en as details //LaravelLocalization::getCurrentLocale()
            )->paginate(PAGINATION_COUNT);


        return view('offers.index',compact('offers'));
    }

    public function edit($offer_id)
    {
        //check if id is exist or not
        $offer= Offer::find($offer_id);
        if(!$offer)
        return redirect()->back()->with(['error'=>'NOT EXIST']);

        //edit by get all data or d=specific data
        $offers = Offer::find($offer_id);
        return view('offers.edit',compact('offers'));


    }

    public function update(OfferRequest $request,$offer_id)
    {
        //validation in extract traint (OfferRequest)

        //check if id is exist or not
        $offer= Offer::find($offer_id);
        if(!$offer)
        return redirect()->back();

        //update data
        $offer->update([
            'name_ar'    =>$request->name_ar,
            'name_en'    =>$request->name_en,
            'details_ar' =>$request->details_ar,
            'details_en' =>$request->details_en,
            'price'      => $request->price
        ]);
        return redirect()->back()->with(['success'=>'تم الاضافه بنجاح']);



        /*
        $offer->update($request->all());
        return redirect()->back()->with(['success'=>'تم الاضافه بنجاح']);
        */


    }
    public function delete($id)
    {

        //$offer = Offer::where('id',$id)->first();
        $offer = Offer::find($id);
        if(!$offer)
        return redirect()->back()->with(['error'=>'NOT EXIST']);
        //delete
        $offer->delete();
        return redirect()->route('offers.index')->with(['success'=>'تم الحذف بنجاح']);
    }

    public function showDataTable()
    {
        return view('datatable.datatable');
    }












}
