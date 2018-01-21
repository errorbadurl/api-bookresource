<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\PurchaseCollection;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Model\Purchase;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * @resource User
 */
class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api')->except('login', 'register');
    }

    /**
     * User View
     *
     * Displays user information.
     *
     * @method GET
     * @return \App\Http\Resources\UserResource
     */
    public function showUser()
    {
        return new UserResource(User::find(Auth::id()));
    }

    /**
     * User Login
     *
     * Fetches an access token to be used as an authentication for the API.
     *
     * @method POST
     * @param  \App\Http\Requests\UserLoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(UserLoginRequest $request)
    {
        // Check if user email exists
        if (!User::where('email', $request->email)->first()) {
            return response()->json([
                'message' => "The user dos not exist."
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        // Attempt user login
        if (Auth::attempt(array('email' => $request->email, 'password' => $request->password))) {
            // Get auth user
            $user = Auth::user();
            $success = array(
                'token' => $user->createToken('BookResourceApp')->accessToken, // create access token
                'first_name' => $user->first_name,
                'last_name' => $user->last_name
            );
            // Return data with user access token
            return response()->json(['data' => $success], Response::HTTP_OK);
        }
        // If user login fails
        return response()->json([
            'message' => "Incorrect password."
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * User Registration
     *
     * Creates a new user.
     *
     * @method POST
     * @param  \App\Http\Requests\UserRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request)
    {
        // Create new auth user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $success = array(
            'token' => $user->createToken('BookResourceApp')->accessToken,
            'name' => $user->name,
        );
        // Return data with user access token
        return response()->json(['success' => $success], Response::HTTP_OK);
    }

    /**
     * User's Book List
     *
     * Displays a list of all books created by the user.
     * 
     * @method GET
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function books(Request $request)
    {
        return BookCollection::collection($request->user()->books()->paginate(10));
    }

    /**
     * User's Purchase List
     *
     * Displays a list of all book purchases by the user.
     *
     * @method GET
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function purchases(Request $request)
    {
        return PurchaseCollection::collection(Purchase::where('user_id', $request->user()->id)->paginate(10));
    }
}
