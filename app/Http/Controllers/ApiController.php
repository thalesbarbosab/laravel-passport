<?php

namespace App\Http\Controllers;

use Exception;
use App\User;
use App\Http\Requests\UserRequest;
use App\Task;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $user;
    protected $task;

    public function __construct(User $user,Task $task)
    {
        $this->user = $user;
        $this->task = $task;
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

    public function tasks()
    {
        try
        {
            return response()->json($this->task->orderBy('created_at')->get());
        }
        catch(Exception $e)
        {
            return response($e->getMessage(),500);
        }
    }

    public function storeTask(Request $request)
    {
        try
        {
            $task = $this->task->create($request->all());
            return response()->json('task created successfully, id: '.$task->id,201);
        }
        catch(Exception $e)
        {
            return response($e->getMessage(),500);
        }
    }

    public function deleteTask($id)
    {
        $task = $this->task->findOrFail($id);
        try
        {
            $task->delete();
            return response()->json('task deleted successfully');
        }
        catch(Exception $e)
        {
            return response($e->getMessage(),500);
        }
    }
}
