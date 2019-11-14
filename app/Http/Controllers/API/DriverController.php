<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Hash;
use App\Drivers; 
use Illuminate\Support\Facades\Auth; 
use Validator;


class DriverController extends Controller
{
	public $successStatus = 200;

	public function login()
	{
		$validatedData = request()->validate([
			'email' => 'required',
			'password' => 'required|min:6'
		]);
		// get user object
		$user = Drivers::where('email', request()->email)->first();
		// do the passwords match?
		if (!Hash::check(request()->password, $user->password)) {
			// no they don't
			return response()->json(['error' => 'Unauthorized'], 401);
		}
		// log the user in (needed for future requests)
		Auth::login($user);
		// get new token
		$tokenResult = $user->createToken('MyApp');
		// return token in json response
		return response()->json(['success' => ['token' => $tokenResult->accessToken]], 200);
	}


	public function login___(){ 

		if(auth()->guard('web')->attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::Drivers(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

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

    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
}



