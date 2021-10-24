<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function allUsers();

    public function createUserAccount($request);

}
