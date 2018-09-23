<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Program;
use http\Exception;
use Illuminate\Http\Request;

class ProgramController extends Controller
{

    public function delete($id)
    {
        $program = Program::findOrFail($id);
        if($program)
            $program->delete();
        else
            return response()->json(error);
        return response()->json(null);
    }

    public function findAll()
    {
        return Program::all();
    }

    public function find($id)
    {
        return Program::find($id);
    }

    public function update(Request $request)
    {
        try {
            $program  = Program::find($request['id']);
            $program->title = $request['title'];
            $program->description = $request['description'];
            $program->save();

        } catch (\Exception $e) {
            return "error";
        }

        return "success";
    }

    public function store(Request $request){

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

            $program = new Program();
            $program->title = $request['title'];
            $program->description = $request['description'];
            $program->save();

            return "success";

        }catch(Exception $e){

            return "error";

        }

    }
}
