<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @var Administrator
     */
    private $administrator;

    /**
     * AuthController constructor.
     *
     * @param Administrator $administrator
     */
    public function __construct(Administrator $administrator)
    {
        $this->administrator = $administrator;
    }

    /**
     * Log an administrator in.
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LoginRequest $request)
    {
        /** @var Administrator $admin */
        $admin = $this->administrator->where('username', $request->username)->firstOrFail();
        if (Hash::check($request->password, $admin->password)) {
            $admin->api_token = str_random(128);
            $admin->save();

            return response()->json($admin);
        }

        abort(401, 'Invalid credentials');
    }

    /**
     * Show the current logged in administrator.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        return response()->json($request->administrator);
    }

    /**
     * Logs an administrator out.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $request->administrator->api_token = null;
        $request->administrator->save();

        return response()->json();
    }
}
