<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Scopes\OfferScope;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

define('paginations', 5);

class CrudController extends Controller
{
    use OfferTrait;

    public function index()
    {
//        $offers = Offer::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name'
//            , 'price'
//            , 'details_' . LaravelLocalization::getCurrentLocale() . ' as details','photo')->get();
//        return view('offers.all', compact('offers'));
        ############## paginate##############
        $offers = Offer::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name'
            , 'price'
            , 'details_' . LaravelLocalization::getCurrentLocale() . ' as details', 'photo')->paginate(paginations);
        //  return view('offers.all', compact('offers'));
        return view('offers.pagination', compact('offers'));
    }

    public function create()
    {
        return view('offers.create');
    }

    public function store(OfferRequest $request)
    {
//     $rules=$this->rules();
//     $messages=$this->messages();
//
//        $validator = Validator::make($request->all(),$rules,$messages);
//      if ($validator -> fails()){
//          return  redirect()->back()->withErrors($validator)->withInput($request->all());
//      }

//save photo in images/offers file
        $file_name = $this->saveimages($request->photo, 'images/offers');


        Offer::create([
                'photo' => $file_name,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'price' => $request->price,
                'details_ar' => $request->details_ar,
                'details_en' => $request->details_en,
            ]

        );
        return redirect()->back()->with(['sucess' => __('messages.sucess')]);

    }

    public function edit($offer_id)
    {
        //   Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id);
        if (!$offer) {
            return redirect()->back();
        }

        $offer = Offer::select('id', 'name_en', 'name_ar', 'price', 'details_en', 'details_ar')->find($offer_id);
        return view('offers.edit', compact('offer'));
    }

    public function update(OfferRequest $request, $offer_id)
    {
        $offer = Offer::find($offer_id);
        if (!$offer) {
            return redirect()->back();
        }
        $offer->update($request->all());
        return redirect(route('offers.all'))->with(['sucess' => __('messages.sucess')]);

    }

    public function delete($offer_id)
    {
        $offer = Offer::find($offer_id);
        if (!$offer) {
            return redirect()->back()->with(['error' => __('messages.fail')]);
        }
        $offer->delete();
        return redirect(route('offers.all'))->with(['sucess' => __('messages.sucess')]);
    }

    public function getInactiveOffers()
    {
        //  return $inactive = Offer::where('status', 0)->get();
//        return $inactive = Offer::inactive()->get();
        #### global scope
        return $inactive = Offer::get();
        //remove global
//             return $inactive = Offer::withoutGlobalScope(OfferScope::class)-> get();

    }

}
