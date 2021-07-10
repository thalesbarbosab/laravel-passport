<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\User\UserAllFieldsRequest;
use App\Http\Requests\User\UserAllFieldsUpdateRequest;
use App\Http\Requests\User\UserChangePasswordRequest;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Tools\Sanitize;

class UserController extends ApiController
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function reset(Request $request)
    {
        app(ForgotPasswordController::class)->sendResetLinkEmail($request);
        return response()->json(['message' => 'recovery link was sended for the e-mail'],200);
    }

    public function store(UserAllFieldsRequest $request)
    {
        try{
            $request->merge([
                'id'=>app(Sanitize::class)->generateUniqueId(),
                'password'=>bcrypt($request->password)
            ]);
            $this->user->create($request->all());
            return response()->json(['message' => 'User has been created succefully'],201);
        }
        catch(\Exception $e){
            return response()->json(['error' =>'Ops! Some error ocurred: '.$e->getMessage()], 500);
        }
    }

    public function index()
    {
        try{
            $user = $this->user->all();
            return response()->json($user,200);
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Ops! Some error ocurred: '.$e->getMessage()], 500);
        }
    }

    public function me()
    {
        try{
            $user = auth()->user();
            return response()->json($user,200);
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Ops! Some error ocurred: '.$e->getMessage()], 500);
        }
    }


    public function update(UserAllFieldsUpdateRequest $request)
    {
        $user = $this->user->findOrFail(auth()->user()->id);
        try{
            $user->update($request->all());
            return response()->json(['message' => 'User data has been changed succefully'],200);
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Ops! Some error ocurred: '.$e->getMessage()], 500);
        }
    }

    public function changePassword(UserChangePasswordRequest $request)
    {
        $user = $this->user->findOrFail(auth()->user()->id);
        try{
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json(['message' => 'User password has been changed succefully'],200);
        }
        catch(\Exception $e){
            return response()->json(['error' =>'Ops! Some error ocurred: '.$e->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        try{
            $request->user()->token()->revoke();
            return response()->json(['message' => 'User logged out succefully'],200);
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Ops! Some error ocurred: '.$e->getMessage()], 500);
        }
    }
}
