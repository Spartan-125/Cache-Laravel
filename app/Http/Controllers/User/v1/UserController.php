<?php

namespace App\Http\Controllers\User\v1;

use App\Http\Controllers\Controller;
use App\Modules\User\Application\AllUsers;
use App\Modules\User\Application\Md5User;
use App\Modules\User\Application\OneUser;
use App\Modules\User\Infraestructure\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() : JsonResponse
    {
        $instanceUsers = new AllUsers($this->userRepository);
        $users = $instanceUsers->get();
        return response()->json($users, 200)->header('Cache-Control', 'max-age=3600');
    }

    public function indexTwo() : JsonResponse
    {
        $instanceUsers = new AllUsers($this->userRepository);
        $users = $instanceUsers->get();
        return response()->json($users, 200);
    }

    public function oneUser() : JsonResponse
    {
        $instanceUsers = new OneUser($this->userRepository);
        $user = $instanceUsers->get();
        $userInstance = new Md5User($this->userRepository);
        $user->token = $userInstance->convertMd5();
        return response()->json($user, 200)->header('Cache-Control', 'max-age=3600');
    }

    public function oneUserTwo() : JsonResponse
    {
        $instanceUsers = new OneUser($this->userRepository);
        $user = $instanceUsers->get();
        $userInstance = new Md5User($this->userRepository);
        $user->token = $userInstance->convertMd5();
        return response()->json($user, 200)->header('Cache-Control', 'max-age=3600');
    }

}
