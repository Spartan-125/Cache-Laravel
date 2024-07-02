<?php

namespace App\Modules\User\Application;

use App\Modules\User\Domain\UserRepositoryInterface;

class Md5User
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function convertMd5() : string
    {
        $user = $this->repository->getUser();
        return md5("$user->id-$user->name-$user->email-$user->password");
    }
}
