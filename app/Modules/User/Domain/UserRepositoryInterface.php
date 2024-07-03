<?php

namespace App\Modules\User\Domain;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

interface UserRepositoryInterface
{
    public function getAllUsers() : Collection | SupportCollection;
    public function getUser() : User | null;
}
