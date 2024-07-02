<?php

namespace App\Modules\User\Domain;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAllUsers() : Collection;
    public function getUser() : User | null;
}
