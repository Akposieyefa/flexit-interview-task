<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\EmailVerificationRepositoryInterface;

class EmailVerificationController extends Controller
{
    private $emailVerificationRepositoryInterface;

    public function __construct(EmailVerificationRepositoryInterface $emailVerificationRepositoryInterface)
    {
        $this->emailVerificationRepositoryInterface  =  $emailVerificationRepositoryInterface;
    }
    
    //verify user email
    public function verify(Request $request)
    {
        return  $this->emailVerificationRepositoryInterface->verifyEmailAddress($request);
    }
}
