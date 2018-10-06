<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutoratController extends Controller
{

    public function store(Request $request, Calendar $calendar)
    {
        try{
            $calendar->createRegister($request);

            return "success";

        }catch(Exception $e){

            return "error";

        }

    }
}
