<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Program;
use http\Exception;
use Illuminate\Http\Request;

class ProgramController extends Controller
{

    public function delete($id, Program $program)
    {
        return $program->deleteRegister($id);
    }

    public function findAll(Program $program)
    {
        return $program->returnAllRegisters();
    }

    public function find($id, Program $program)
    {
        return $program->returnRegister($id);
    }

    public function update($id, Request $request, Program $program)
    {
        try {

            $program->updateRegister($id ,$request);

        } catch (\Exception $e) {
            return "error";
        }

        return "success";
    }

    public function store(Request $request, Program $program)
    {
//        $rules = array (
//
//            'api_token' => 'required',
//            'title' => 'required'
//        );

//        $validator = Validator::make($request->all(), $rules);
//
//        if ($validator-> fails()){
//
//            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
//
//        }

//        $api_token = $request['api_token'];

        try{

//            $user = JWTAuth::toUser($api_token);


            $program->createRegister($request);

            return "success";

        }catch(Exception $e){

            return "error";

        }

    }
}
