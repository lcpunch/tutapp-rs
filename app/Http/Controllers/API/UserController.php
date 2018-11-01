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

        if(Auth::attempt(['registration_number' => request('email'), 'password' => request('password')])) {

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
        return User::find($id);
    }

    public function findAll(User $user)
    {
        return $user->returnAllRegisters();
    }

    public function find($id, User $user)
    {
        if($id != '-1') {
            return $user->returnRegister($id);
        } 
        return $user->returnAllRegisters();
    }

    public function update($id, Request $request)
    {
        try {
          $user = User::find($id);
          $user->name                = $request->get('name');
          $user->email               = $request->get('email');
          $user->program_id          =  $request->get('program_id');
          $user->registration_number =  $request->get('registration_number');
          $user->role                = (int)$request->get('role');

          if (!empty($request->get('password'))) {
            $user->password = bcrypt($request->get('password'));
          }

          $user->save();
        } catch (\Exception $e) {
            return response()->json(["error" => $e]);
        }

        return "success";
    }

    public function store(Request $request, User $user)
    {
        try{
          $user->name                = $request['name'];
          $user->email               = $request['email'];
          $user->role                = $request['role'];
          $user->password            = $request['password'];
          $user->program_id          = $request['program_id'];
          $user->registration_number = $request['registration_number'];
          $user->save();

          return "success";
        }catch(Exception $e){
          return "error";
        }
    }

    public function import(Request $request, Program $programModel)
    {
      $users = $request->get('file');
      array_shift($users);

      foreach ($users as $user)
      {
        $userModel           = new User();
        $userModel->name     = $user[1];
        $userModel->role     = 3;
        $userModel->password = bcrypt('secret');
        $userModel->email    = $user[0];

        $program = $programModel->returnRegirterByTitle($user[2]);
        if($program) {
          $userModel->program_id = $program->id;
        }

        $userModel->registration_number = $user[0];
        $userModel->save();
      }
    }

    public function delete($id, User $user)
    {
        return $user->deleteRegister($id);
    }
}
