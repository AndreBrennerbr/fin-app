<?php
namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserInterfaceRepository
{
    public function all(): array;
    public function findById(int $id): ?User;
    public function create(array $data): User;
    public function update(int $id, array $data): bool;
}