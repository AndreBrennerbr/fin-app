<?php 
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserInterfaceRepository;

class UserRepository implements UserInterfaceRepository{


    public function all(): array
    {
        return User::all()->toArray();
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $user = User::find($id);
        if (!$user) {
            return false;
        }
        return $user->update($data);
    }





}