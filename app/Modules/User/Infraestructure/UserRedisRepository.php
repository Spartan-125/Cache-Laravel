<?php

namespace App\Modules\User\Infraestructure;

use App\Models\User;
use App\Modules\User\Domain\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Redis;

class UserRedisRepository implements UserRepositoryInterface
{
    protected $wrapped;

    public function __construct(UserRepositoryInterface $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    public function getAllUsers() : Collection | SupportCollection
    {
        $cache = Redis::get('all_users');
        if ($cache) {
            return collect(json_decode($cache, true));
        }
        $users = $this->wrapped->getAllUsers();

        Redis::set('all_users', $users->toJson());
        return $users;
    }

    public function getUser() : User | null
    {
        $cache = Redis::get('one');
        if ($cache) {
            $data = json_decode($cache, true);
            $user = new User();
            $user->id = $data['id'];
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->email_verified_at = $data['email_verified_at'];
            $user->created_at = $data['created_at'];
            $user->updated_at = $data['updated_at'];
            return $user;
        }
        $user = $this->wrapped->getUser();

        Redis::set('one', $user->toJson());
        return $user;
    }
}
