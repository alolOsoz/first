<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;

    //
    public function create()
    {
        return view('ajaxoffers.create');
    }

    public function save(OfferRequest $request)
    {
        $file_name = $this->saveimages($request->photo, 'images/offers');

        $offer = Offer::create([
                'photo' => $file_name,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'price' => $request->price,
                'details_ar' => $request->details_ar,
                'details_en' => $request->details_en,
            ]

        );
        if ($offer)
            return response()->json([
                'status' => true,
                'msg' => __('messages.sucess'),
            ]);
        else
            return response()->json([
                'status' => false,
                'msg' => 'failed',
            ]);


    }

    public function all()
    {
        $offers = Offer::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name'
            , 'price'
            , 'details_' . LaravelLocalization::getCurrentLocale() . ' as details')->get();
        return view('ajaxoffers.all', compact('offers'));

    }

    public function edit(Request $request)
    {
        //   Offer::findOrFail($offer_id);
        $offer = Offer::find($request->offer_id);
        if (!$offer) {

            return response()->json([
                'status' => false,
                'msg' => 'failed',
            ]);
        }
        $offer = Offer::select('id', 'name_en', 'name_ar', 'price', 'details_en', 'details_ar')->find($request->offer_id);
        return view('ajaxoffers.edit', compact('offer'));
    }

    public function update(OfferRequest $request)
    {
        $offer = Offer::find($request->offer_id);
        if (!$offer) {
            return response()->json([
                'status' => false,
                'msg' => 'failed',
            ]);
        }
        $offer->update($request->all());

        return response()->json([
            'status' => true,
            'msg' => __('messages.sucess'),
        ]);


    }

    public function delete(Request $request)
    {
        $offer = Offer::find($request->id);
        if (!$offer) {
            return redirect()->back()->with(['error' => __('messages.fail')]);
        }
        $offer->delete();
        return response()->json([
            'status' => true,
            'msg' => __('messages.sucess'),
            'id' => $request->id,
        ]);
    }
}
