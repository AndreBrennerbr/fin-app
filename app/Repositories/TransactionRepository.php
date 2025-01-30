<?php 
namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionInterfaceRepository;

class TransactionRepository implements TransactionInterfaceRepository{

    public function all(): array
    {
        try {
            return Transaction::all()->toArray();
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \RuntimeException('Erro ao listar transações', 500);
        }
        
    }

    public function findById(int $id): ?Transaction
    {
        try {
            return Transaction::find($id);
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \RuntimeException('Erro ao listar a transação', 500);
        }
        
    }

    public function create(array $data): Transaction
    {
        try {
            return Transaction::create($data);
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \RuntimeException('Erro ao criar transação', 500);
        }
      
    }

    public function update(int $id, array $data): bool
    {
        try {
            $transaction = Transaction::find($id);
            if (!$transaction) return false;
            return $transaction->update($data);
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \RuntimeException('Erro ao atualizar transação', 500);
        }
        
    }


}