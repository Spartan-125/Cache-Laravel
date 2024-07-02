<?php

namespace App\Modules\User\Infraestructure;

use App\Models\User;
use App\Modules\User\Domain\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAllUsers() : Collection
    {
        return $this->model::all();
    }

    public function getUser() : User | null
    {
        return $this->model::where('id', 1)->first();
    }
}
