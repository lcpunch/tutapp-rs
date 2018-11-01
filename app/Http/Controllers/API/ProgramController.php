<?php

namespace App\Http\Controllers\API;

use App\Course;
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
        if($id > -1)
            return $program->returnRegister($id);
        else
            return $program->returnAllRegisters();
    }

    public function update($id, Request $request, Program $program)
    {
        try {

            $program->updateRegister($id ,$request);

        } catch (\Exception $e) {
            return response()->json(["error" => "can't update :".$id]);
        }

        return response()->json(["success" => "updated :".$id]);
    }

    public function listCoursesByProgram($id)
    {
        return Course::where('program_id', '=' , $id)->get();
    }

    public function listProgramByUser($id)
    {
        return Program::join('users', 'users.program_id', '=', 'programs.id')
            ->where('users.id', '=', $id)
            ->select('programs.title', 'programs.description', 'programs.id')
            ->getQuery()
            ->get();
    }

    public function store(Request $request, Program $program)
    {
        try{
            $program->createRegister($request);

            return response()->json(["success" => "stored :".$request]);

        }catch(Exception $e){

            return response()->json(["error" => "can't store :".$request]);

        }

    }
}
