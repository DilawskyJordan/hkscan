<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

// eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvcmVxdWVzdFRva2VuIiwiaWF0IjoxNjA0NzY4MzUwLCJleHAiOjE2MDQ3NzE5NTAsIm5iZiI6MTYwNDc2ODM1MCwianRpIjoiVmR3SWt1em15RWNDQ1A3NCIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.I3YSkP--nrUJSWNtyImY9kqFfB9bXPU6sYfySlofLNo

class UserController extends BaseController {
    public function login(Request $request) {
    	$data = $request->only(["email", "password"]);
    	if (!$token = Auth::attempt($data)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }
    public function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
