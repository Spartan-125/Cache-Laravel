<?php

namespace App\Modules\User\Application;

use App\Modules\User\Domain\UserRepositoryInterface;
use App\Modules\User\Infraestructure\UserRedisRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class AllUsers
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = new UserRedisRepository($repository);
    }

    public function get() : Collection | SupportCollection
    {
        return $this->repository->getAllUsers();
    }
}
