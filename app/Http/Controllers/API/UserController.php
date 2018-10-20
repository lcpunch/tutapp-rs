<?php
namespace App\Http\Controllers\API;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Program;


class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login() {

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $user = Auth::user();
            try {
                $success['token'] = $user->createToken('tutapp-rs')->accessToken;

                return response()->json([
                    'success' => $success,
                    "id" => $user->id,
                    "role" => $user->role
                ], $this->successStatus);
            } catch (\Exception $e) {
                return response()->json(['error'=>'Error: '.$e]);
            }
        }
        else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this-> successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
//        $user = Auth::user();
//        return response()->json(['success' => $user], $this-> successStatus);
        return User::find($id);
    }

    public function findAll(User $user)
    {
        return $user->returnAllRegisters();
    }

    public function find($id, User $user)
    {
        return $user->returnRegister($id);
    }

    public function update($id, Request $request)
    {
        try {
          $user = User::find($id);
          $user->name = $request->get('name');
          $user->email = $request->get('email');
          //$course->program_id = $request['program_id'];
          $user->role = (int)$request->get('role');
          $user->save();
        } catch (\Exception $e) {
            return response()->json(["error" => $e]);
        }

        return "success";
    }

    public function store(Request $request, User $user)
    {
        try{
            //$program = Program::find($request['program_id']);

            //if($program) {
                $user->name = $request['name'];
                $user->email = $request['email'];
                $user->role = $request['role'];
                $user->password = $request['password'];
                //$user->program_id = 3;
                $user->save();
            //} else {
            //    return response()->json(["error" => "You need to inform a valid program id"]);
            //}

            return "success";

        }catch(Exception $e){

            return "error";

        }

    }

    public function delete($id, User $user)
    {
        return $user->deleteRegister($id);
    }
}
