<?php

namespace App\Http\Controllers\Mobile;

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
        return new UserResource(User::create($request->all()));
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
        return new UserResource($user->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $updateToken = $user->createToken('update-token', ['update']);

            return response()->json(
                [
                    'Api_Token' => $updateToken->plainTextToken,
                    'result' => new UserResource($user)
                ],
                200
            );
        }
    }
    public function signup(Request $request)
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
            //throw $th;
            return $e;
        }
    }

    public function auth(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->access_token);
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

        return response()->json(
            [
                'Api_Token' => $request->access_token,
                'result' => new UserResource($user)
            ],
            200
        );
    }
}
