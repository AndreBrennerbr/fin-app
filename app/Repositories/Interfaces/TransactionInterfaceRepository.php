<?php
namespace App\Repositories\Interfaces;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

interface TransactionInterfaceRepository
{
    public function all(array $params,array $dateFilter);
    public function findById(int $id): ?Collection;
    public function create(array $data): Transaction;
    public function update(int $id, array $data): bool;
}