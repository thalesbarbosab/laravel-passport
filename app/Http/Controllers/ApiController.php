<?php

namespace App\Http\Controllers;

use Exception;
use App\User;
use App\Http\Requests\UserRequest;

class ApiController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function users()
    {
        try
        {
            return response()->json($this->user->all());
        }
        catch(Exception $e)
        {
            return response($e->getMessage(),500);
        }
    }

    public function me()
    {
        try
        {
            return response()->json(auth()->user());
        }
        catch(Exception $e)
        {
            return response($e->getMessage(),500);
        }
    }

    public function storeUser(UserRequest $request)
    {
        try
        {
            $request->merge([
                'password' => bcrypt($request->password)
            ]);
            $user = $this->user->create($request->all());
            return response()->json($user,201);
        }
        catch(Exception $e)
        {
            return response($e->getMessage(),500);
        }
    }
}
