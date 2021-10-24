<?php

namespace App\Repositories;

use App\Actions\UserAction;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class UserRepository implements UserRepositoryInterface
{
    private $action;

    public function __construct(UserAction $action)
    {
        $this->action = $action;
    }

    //create user
    public function createUserAccount($request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'success' => false
            ], 422);
        }else {
            return  $this->action->createUserAccount($request);
        }
    }

    //all user
    public function allUsers()
    {
    return $this->action->all();
    }

}
