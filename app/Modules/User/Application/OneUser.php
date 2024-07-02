<?php

namespace App\Modules\User\Application;

use App\Models\User;
use App\Modules\User\Domain\UserRepositoryInterface;

class OneUser
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get() : User
    {
        return $this->repository->getUser();
    }
}
