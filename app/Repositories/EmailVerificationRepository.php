<?php

namespace App\Repositories;

use App\Repositories\Contracts\EmailVerificationRepositoryInterface;
use App\Models\AccountVerificationToken;
use App\Models\User;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EmailVerificationRepository implements EmailVerificationRepositoryInterface
{

    //verify
    public function verifyEmailAddress($request)
    {
        $validator =  Validator::make($request->all(),[
              "token"  =>  'required',
          ]);

          if ($validator->fails()) {
              return response()->json([
                  'message' => $validator->errors(),
                  'success' => false
              ], 422);
          }else {
             $token = AccountVerificationToken::where('token', '=', $request->token)->first();
             if ($token) {
                  $verify = User::where('email', '=', $token->email)->first();
                  $ack = $verify->update([
                      'email_verified_at' => Carbon::now()
                  ]);
                  return response()->json([
                      'message' => 'Email have  been  verified',
                      'success' => true
                  ], 200);
             }else {
              return response()->json([
                  'message' => 'Token not found',
                  'success' => false
              ], 404);
             }
          }
    }
    
}
