<?php

namespace App\Http\Controllers\API;

use App\Course;
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

    public function find($id, Course $course)
    {
        return $course->returnRegister($id);
    }

    public function update($id, Request $request)
    {
        try {

            $program = Program::find($request['program_id']);

            if($program) {

                $course = Course::find($id);
                $course->title = $request['title'];
                $course->program_id = $request['program_id'];
                $course->save();

            } else {
                return response()->json(["error" => "You need to inform a valid program id"]);
            }

        } catch (\Exception $e) {
            return response()->json(["error" => "Your data seems wrong."]);
        }

        return "success";
    }

    public function store(Request $request, Course $course)
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

            if($program) {
                $course->title = $request['title'];
                $course->program_id = $request['program_id'];
                $course->save();
            } else {
                return response()->json(["error" => "You need to inform a valid program id"]);
            }

            return "success";

        }catch(Exception $e){

            return "error";

        }

    }
}
