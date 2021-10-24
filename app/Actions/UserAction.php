<?php

namespace App\Actions;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\AccountVerificationToken;
use App\Mail\AccountVerificationMail;
use Illuminate\Support\Facades\Hash;

class UserAction
{
    private $model;
    private $account_verification_token;

    public function __construct(User $model, AccountVerificationToken $account_verification_token)
    {
       $this->model = $model;
       $this->account_verification_token = $account_verification_token;
    }

    //create user account
    public function createUserAccount($request)
    {
        $user = $this->model->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        if ($user) {
            $this->sendAccountVerificationEmail($request->email, $request->name);
            return response()->json([
                'message' => 'Account created successfully',
                'data' => $user,
                'success' => true
            ], 200);
        }else {
            return response()->json([
               'message' => 'Sorry unable to create account',
               'success' => false
            ], 400);
        }
    }

    //send verification email
    public function sendAccountVerificationEmail($email, $name)
    {
        $token = Str::random(32);
        $create_token =   $this->account_verification_token->create([
           'email' => $email,
           'token' => $token
        ]);
        try {
            $data = array(
                'title' => 'Account verifiction emil',
                'body' => 'Please verify your email address',
                'token' => $token,
                'name' => $name
            );
            Mail::to($email)->later(now()->addMinutes(2), new AccountVerificationMail($data));
            return true;
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], 400);
        }
    }

    //get all users
    public function all()
    {
        $users = $this->model->latest()->paginate(10);
        if (count($users) < 1) {
            return response()->json([
                'message' => 'Sorry no user found',
                'success' => false
            ], 200);
        }else {
            return UserResource::collection($users);
        }
    }

    //get authenticated user
    public function authUser()
    {
        $user = $this->model->find(auth()->user()->id);
        return new UserResource($user);
    }

    
}
