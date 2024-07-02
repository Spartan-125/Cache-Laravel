<?php

namespace App\Modules\User\Application;

use App\Modules\User\Domain\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AllUsers
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get() : Collection
    {
        return $this->repository->getAllUsers();
    }
}
