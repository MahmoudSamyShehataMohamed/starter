<?php

namespace App\Http\Controllers;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Traits\UploadfileTrait;
use App\Http\Requests\OfferRequest;
use LaravelLocalization;

class AjaxController extends Controller
{
    use UploadfileTrait;
    public function create()
    {
        return view('ajaxs.create');
    }


    public function store(OfferRequest $request)
    {
        $filename = $this->saveFile($request->file,'uploads/offers');

        //insert into DB
        $offer = Offer::create([
        'file'       => $filename,
        'name_ar'    => $request->name_ar,
        'name_en'    => $request->name_en,
        'details_ar' => $request->details_ar,
        'details_en' => $request->details_en,
        'price'      => $request->price,
        ]);

        if($offer)
        return response()->json([
            'status' => true,
            'msg'    => 'تم الحفظ بنجاح',
        ]);

        else
        return response()->json([
            'status' => false,
            'msg'    => 'فشل المحاولة الرجاء حاول مرة اخرى',
        ]);

    }

    public function index()
    {

        $offers = Offer::select(
            'id',
            'price',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details',
            'file'
            )->get();

        return view('ajaxs.index',compact('offers'));
    }


    public function delete(Request $request)
    {
        //$offer = Offer::where('id',$id)->first();
        $offer = Offer::find($request ->id);
        if(!$offer)
        return response()->json([
            'status' => false,
            'msg'    => 'غير موجود',
        ]);

        //delete
        $offer->delete();
        return response()->json([
            'status' => true,
            'msg'    => 'تم الحذف بنجاح',
            'id'   => $request ->id
        ]);
    }


    public function edit(Request  $request)
    {
         $offer = Offer::find($request -> offer_id);  // search in given table id only
        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'هذ العرض غير موجود',
            ]);

        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($request -> offer_id);

        return view('ajaxs.edit', compact('offer'));

    }

    public  function update(Request $request){
        $offer = Offer::find($request -> offer_id);
        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'هذ العرض غير موجود',
            ]);

        //update data
        $offer->update($request->all());

        return response()->json([
            'status' => true,
            'msg' => 'تم  التحديث بنجاح',
        ]);
    }




}
