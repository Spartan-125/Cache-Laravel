<?php

namespace App\Modules\User\Application;

use App\Models\User;
use App\Modules\User\Domain\UserRepositoryInterface;
use App\Modules\User\Infraestructure\UserRedisRepository;

class OneUser
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = new UserRedisRepository($repository);
    }

    public function get() : User
    {
        return $this->repository->getUser();
    }
}
