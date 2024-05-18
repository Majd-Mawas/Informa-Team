<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UserCollection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $attributes = request()->validate([
                'name' => 'required|string',
                'email' => 'required|string',
                'password' => 'required|string',
                'role_id' => 'required|string',
                'phone' => 'required|string',
                'education' => 'required|string',
            ]);
            if (User::where('email', $attributes['email'])->exists()) {
                return response()->json(['message' => 'Email already in use'], 422);
            }
            $user = User::create($attributes);
            $updateToken = $user->createToken('update-token', ['update']);

            return response()->json(
                [
                    'Api_Token' => $updateToken->plainTextToken,
                    'result' => new UserResource($user)
                ],
                200
            );
        } catch (\Exception $e) {
            abort(500);
            return $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(["data" => "User Deleted Successfully"]);
    }

    public function login(Request $request)
    {
        try {


            $request->validate([
                'email' => 'required|string',
                'password' => 'required|string',
            ]);

            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $updateToken = $user->createToken('update-token', ['update']);
                // $words = preg_split('/\s+/', $user->name);

                return response()->json(
                    [
                        'api_token' => $updateToken->plainTextToken,
                        // "first_name" => $words[0],
                        // "last_name" => $words[1],
                        "fullname" => $user->name,
                        "email" => $user->email,
                        "email_verified_at" => $user->email_verified_at,
                        "created_at" => $user->created_at,
                        "updated_at" => $user->updated_at,
                        // 'result' => new UserResource($user)

                    ],
                    200
                );
            }
        } catch (\Exception $e) {
            //throw $th;
            return $e;
        }
    }
    public function signup(Request $request)
    {
        try {
            $attributes = request()->validate([
                'name' => 'required|string',
                'email' => 'required|string',
                'password' => 'required|string',
                // 'role_id' => 'required|string',
                'phone' => 'required|string',
                // 'education' => 'required|string',
            ]);
            if (User::where('email', $attributes['email'])->exists()) {
                return response()->json(['message' => 'Email already in use'], 422);
            }
            $attributes['role_id'] = 3; // Visitor Role
            $attributes['education'] = 'كلية الهندسة المعلوماتية';
            unset($attributes['password_confirmation']);
            $user = User::create($attributes);
            $updateToken = $user->createToken('update-token', ['update']);

            return response()->json(
                [
                    'api_token' => $updateToken->plainTextToken,
                    // "first_name" => $words[0],
                    // "last_name" => $words[1],
                    "fullname" => $user->name,
                    "email" => $user->email,
                    "email_verified_at" => $user->email_verified_at,
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,
                    // 'result' => new UserResource($user)
                ],
                200
            );
        } catch (\Exception $e) {
            //throw $th;
            return $e;
        }
    }

    public function auth(Request $request)
    {
        try {
            $token = PersonalAccessToken::findToken($request->api_token);
            if (!$token) {
                return response()->json(
                    [
                        'message' => 'Token Not Found'
                    ],
                    404
                );
            }
            $user = $token->tokenable;

            if ($user == null) {
                return response()->json(
                    [
                        'message' => 'User Not Found'
                    ],
                    404
                );
            }
            // $words = preg_split('/\s+/', $user->name);

            return response()->json(
                [
                    'api_token' => $request->api_token,
                    // "first_name" => $words[0],
                    // "last_name" => $words[1],
                    "fullname" => $user->name,
                    "email" => $user->email,
                    "email_verified_at" => $user->email_verified_at,
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,
                    // 'result' => new UserResource($user)
                ],
                200
            );
        } catch (\Exception $e) {
            //throw $th;
            return $e;
        }
    }
}

// {
//     "id": 2,
//     "first_name": "Alvena",
//     "last_name": "Ward",
//     "email": "admin@demo.com",
//     "email_verified_at": "2023-07-12T13:39:05.000000Z",
//     "created_at": "2023-07-12T13:39:05.000000Z",
//     "updated_at": "2023-07-12T13:39:05.000000Z",
//     "api_token": "$2y$10$qyWRyuvGf4t9hAOndcV.vu.9ro6LFObwA5ovBoUtmB2ja4i9ipKAW"
// }
