<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Program;
use http\Exception;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function delete($id, Course $course)
    {
        return $course->deleteRegister($id);
    }

    public function findAll(Course $course)
    {
        return $course->returnAllRegisters();
    }

    public function find($id, Program $course)
    {
        return $course->returnRegister($id);
    }

    public function update(Request $request)
    {
        try {

            $program = Program::find($request['program_id']);
            $course  = Course::find($request['id']);
            $course->title = $request['title'];
            $course->program()->associate($program);
            $course->save();

        } catch (\Exception $e) {
            return "error";
        }

        return "success";
    }

    public function store(Request $request, Program $course)
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


            $program = Program::find($request['program_id']);
            $course->title = $request['title'];
            $course->program()->associate($program);
            $course->save();

            return "success";

        }catch(Exception $e){

            return "error";

        }

    }
}
