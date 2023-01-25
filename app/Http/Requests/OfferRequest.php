<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class OfferRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [
            'file' => 'required|mimes:jpeg,jpg,png',
            'name_ar'=>'required|max:100|unique:offers,name_ar',
            'name_en'=>'required|max:100|unique:offers,name_en',
            'price'=>'required|numeric',
            'details_ar'=>'required',
            'details_en'=>'required'
            ];
    }
    public function messages()
    {
        return [
            'name_ar.required'=>__('translate.offer_ar_required'),
            'name_en.required'=>__('translate.offer_en_required'),
            'name_ar.max'=>__('translate.offer_ar_max'),
            'name_en.max'=>__('translate.offer_en_max'),
            'name_ar.unique'=>__('translate.offer_ar_unique'),
            'name_en.unique'=>__('translate.offer_en_unique'),

            'price.required'=>__('translate.pricerequired'),
            'price.numeric'=>__('translate.pricenumeric'),

            'details_ar.required'=>__('translate.details_ar_required'),
            'details_en.required'=>__('translate.detailrs_en_equired')
        ];
    }
}
