<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\PurchaseCollection;
use App\Http\Resources\UserResource;
use App\Model\Purchase;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api')->except('login', 'register');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showUser(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function books(Request $request)
    {
        return BookCollection::collection($request->user()->books()->paginate(10));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserBooks(User $user)
    {
        return BookCollection::collection($user->books()->paginate(10));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function purchases(Request $request)
    {
        return PurchaseCollection::collection(Purchase::where('user_id', $request->user()->id)->paginate(10));
    }

    /**
     * Login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:191',
            'password' => 'required',
        ]);
        $errors = [];
        $error = false;
        if ($validator->fails()) {
            $error = true;
            $errors = $validator->errors();
        }
        $validate = ["error" => $error,"errors"=>$errors];
        if ($validate["error"]) {
            return $this->prepareResult(false, [], $validate['errors'],"Error while validating user");
        }
        $user = User::where("email", $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return $this->prepareResult(true, ["accessToken" => $user->createToken('Book Resource App')->accessToken], [], "User Verified");
            }
            else {
                return $this->prepareResult(false, [], ["password" => "Wrong passowrd"], "Password not matched");
            }
        }
        else {
            return $this->prepareResult(false, [], ["email" => "Unable to find user"], "User not found");
        }
    }

    public function register(Request $request)
    {
        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $request
         * @return \Illuminate\Contracts\Validation\Validator
         */
        $valid = validator($request->only('first_name', 'last_name', 'email', 'password', 'password_confirmation'), [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4'
        ]);
        if ($valid->fails()) {
            $jsonError=response()->json($valid->errors()->all(), Response::HTTP_BAD_REQUEST);
            return \Response::json($jsonError);
        }
        $data = request()->only('first_name', 'last_name', 'email', 'password');
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        // And created user until here.
        $client = \Laravel\Passport\Client::where('password_client', 1)->first();
        // Is this $request the same request? I mean Request $request?
        // Then wouldn't it mess the other $request stuff? Also how did you
        // pass it on the $request in $proxy? Wouldn't Request::create()
        // just create a new thing?
        $request->request->add([
            'grant_type'    => 'password',
            'client_id'     => $client->id,
            'client_secret' => $client->secret,
            'username'      => $data['email'],
            'password'      => $data['password'],
            'scope'         => null,
        ]);
        // Fire off the internal request. 
        $token = Request::create(
            'oauth/token',
            'POST'
        );
        return \Route::dispatch($token);
    }

    /**
     * Prepares the result of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function prepareResult($status, $data, $errors,$msg)
    {
        return ['status' => $status,'data'=> $data,'message' => $msg,'errors' => $errors];
    }
}
