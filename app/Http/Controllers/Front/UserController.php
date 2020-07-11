<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function getindex(){
        $data=[];
        $data['age']=21;
        $data['name']='ali osama';

        return view('welcome')->with($data);

    }
    public function showboot(){
        return view('landline');
    }
}
