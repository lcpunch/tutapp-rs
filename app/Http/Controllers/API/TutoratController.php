<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Tutorat;
use Illuminate\Http\Request;

class TutoratController extends Controller
{
    public function store(Request $request, Tutorat $tutorat)
    {
        try{
            $tutorat->createRegister($request);

            return "success";

        }catch(Exception $e){

            return "error";

        }

    }
}
