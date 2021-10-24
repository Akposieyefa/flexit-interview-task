<?php

namespace App\Repositories\Contracts;

interface AuthRepositoryInterface
{
    public function login($request);

    public function logout($request);

    public function refresh();

    public function userProfile();
    
}