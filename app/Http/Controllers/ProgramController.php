<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProgramResource;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return ProgramResource::collection(Program::with('description')->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $program = Program::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return new ProgramResource($program);
    }

    /**
     * Display the specified resource.
     *
     * @param Program $program
     * @return ProgramResource
     */
    public function show(Program $program)
    {
        return new ProgramResource($program);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Program $program
     * @return ProgramResource
     */
    public function update(Request $request, Program $program)
    {
        $program->update($request->only(['title', 'description']));

        return new ProgramResource($program);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Program $program
     * @return Response
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return response()->json(null, 204);
    }
}
