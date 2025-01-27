<?php
namespace App\Repositories\Interfaces;

use App\Models\Transaction;

interface TransactionInterfaceRepository
{
    public function all(): array;
    public function findById(int $id): ?Transaction;
    public function create(array $data): Transaction;
    public function update(int $id, array $data): bool;
}