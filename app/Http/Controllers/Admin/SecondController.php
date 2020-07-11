<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SecondController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('showString3');
    }

    public function showString(){
        return'hello ali';
    }
    public function showString1(){
        return'hello ali1';
    }
    public function showString2(){
        return'hello ali2';
    }
    public function showString3(){
        return'hello ali3';
    }
}
