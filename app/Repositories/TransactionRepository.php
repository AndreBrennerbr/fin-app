<?php 
namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionInterfaceRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
class TransactionRepository implements TransactionInterfaceRepository{
    
    private $userId;

    public function __construct() {
        $this->userId = Auth::id();
    }
    
    public function all(): array
    {
        try {
            return Transaction::where('user_id', $this->userId)->get()->toArray();
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \RuntimeException('Erro ao listar transações', 500);
        }
        
    }

    public function findById(int $id): ?Collection
    {
        try {
            $transaction = Transaction::where('user_id',$this->userId)
                        ->where('id',$id)
                        ->get();
            return $transaction;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \RuntimeException('Erro ao listar a transação', 500);
        }
        
    }

    public function create(array $data): Transaction
    {
        try {
            $transaction = New Transaction();
            $transaction->user_id = $this->userId;
            $transaction->fill($data); 
            $transaction->save(); 
            return  $transaction;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \RuntimeException('Erro ao criar transação', 500);
        }
      
    }

    public function update(int $id, array $data): bool
    {
        try {
            $transaction = Transaction::where('user_id', $this->userId)
                    ->where('id',$id)
                    ->first();
            if (!$transaction) return false;
            return $transaction->update($data);
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \RuntimeException('Erro ao atualizar transação', 500);
        }
        
    }


}