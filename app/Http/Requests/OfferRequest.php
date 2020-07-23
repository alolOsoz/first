<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_en' => 'required|max:100|unique:offers,name_en',
            'name_ar' => 'required|max:100|unique:offers,name_ar',
            'price' => 'required|numeric',
            'details_en' => 'required',
            'details_ar' => 'required',
            'photo' => 'required',
            //
        ];
    }

    public function messages()
    {
        return $messages = [
            'name_en.required' => __('messages.offer name en required'),
            'name_ar.required' => __('messages.offer name ar required'),
            'name_en.unique' => __('messages.offer name en unique'),
            'name_ar.unique' => __('messages.offer name ar unique'),
            'name ar.max' => __('messages.offer name ar max'),
            'name en.max' => __('messages.offer name en max'),
            'price.numeric' => __('messages.offer price numeric'),
            'price.required' => __('messages.offer price required'),
            'details_en.required' => __('messages.offer details en required'),
            'details_ar.required' => __('messages.offer details ar required'),
            'photo.required' => __('messages.offer photo required'),
        ];
    }
}
