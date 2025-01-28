<?php 
namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionInterfaceRepository;

class TransactionRepository implements TransactionInterfaceRepository{

    public function all(): array
    {
        return Transaction::all()->toArray();
    }

    public function findById(int $id): ?Transaction
    {
        return Transaction::find($id);
    }

    public function create(array $data): Transaction
    {
        return Transaction::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return false;
        }
        return $transaction->update($data);
    }


}