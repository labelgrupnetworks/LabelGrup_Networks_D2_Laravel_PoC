<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->hasDirectPermission('get user'))
        {
            $users = User::all();
            return response()->json([
                'status'    => true,
                'users'     => $users
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'User doesnt have permission to this action'
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if($user->hasDirectPermission('create user'))
        {
            $user = $this->user::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);

            return response()->json([
                'status'    => true,
                'message'   => 'User created successfully',
                'user'  => $user
            ], 200);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'User doesnt have permission to this action'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();

        if($user->hasDirectPermission('edit user'))
        {
            $user->update($request->all());

            return response()->json([
                'status'    => true,
                'message'   => 'User updated successfully',
                'user'  => $user
            ], 200);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'User doesnt have permission to this action'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $user = Auth::user();

        if($user->hasDirectPermission('delete user'))
        {
            if(Auth::user()->id == $user->id){
                return response()->json([
                    'status'    => true,
                    'message'   => 'Cannot delete your own user'
                ], 401);
            }

            $user->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'User deleted successfully'
            ], 200);
        }else {
            return response()->json([
                'status'    => true,
                'message'   => 'User doesnt have permission to this action'
            ], 200);
        }


    }

    // Register new user
    public function register(Request $request)
    {
        // validate the incoming request
        // set every field as required
        // set email field so it only accept the valid email format

        $this->validate($request, [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users',
            'password' => 'required|string|min:6|max:255',
        ]);

        // if the request valid, create user

        $user = $this->user::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        // login the user immediately and generate the token
        $token = auth()->login($user);

        // return the response as json
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'User created successfully!',
            ],
            'data' => [
                'user' => $user,
                'access_token' => [
                    'token' => $token,
                    'type' => 'Bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60,    // get token expires in seconds
                ],
            ],
        ]);
    }

    // JWT Validation method
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // attempt a login (validate the credentials provided)
        $token = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // if token successfully generated then display success response
        // if attempt failed then "unauthenticated" will be returned automatically
        if ($token)
        {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Quote fetched successfully.',
                ],
                'data' => [
                    'user' => auth()->user(),
                    'access_token' => [
                        'token' => $token,
                        'type' => 'Bearer',
                        'expires_in' => auth()->factory()->getTTL() * 60,
                    ],
                ],
            ]);
        }else {
            return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
        }
    }

    // Logout user
    public function logout()
    {
        // get token
        $token = JWTAuth::getToken();

        // invalidate token
        $invalidate = JWTAuth::invalidate($token);

        if($invalidate) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Successfully logged out',
                ],
                'data' => [],
            ]);
        }
    }

}
