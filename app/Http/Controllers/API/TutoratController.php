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

            return response()->json(['message' => 'success']);

        }catch(Exception $e){

            return response()->json(['error' => 'error: '.$e]);

        }

    }
}
