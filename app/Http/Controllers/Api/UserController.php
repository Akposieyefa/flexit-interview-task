<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth:api', ['except' => ['createUser']]);
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->userRepository->allUsers();
    }

    public function show($id)
    {
        return $this->userRepository->findUser($id);
    }

    public function createUser(Request $request)
    {
        return $this->userRepository->createUserAccount($request);
    }


    public function destroy($id)
    {
        return $this->userRepository->deleteUser($id);
    }

}
