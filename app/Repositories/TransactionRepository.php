<?php 
namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionInterfaceRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
class TransactionRepository implements TransactionInterfaceRepository{
    
    private $userId;

    public function __construct() {
        $this->userId = Auth::id();
    }
    
    public function all(null|array $params = null,null|array $dateFilter = null)
    {  
        try {
            return Transaction::where('user_id', $this->userId)
                                ->when($params,function ($query) use ($params) {
                                    foreach ($params as $key => $value) {
                                        $query->where($key, $value);
                                    }
                                })
                                ->when($dateFilter,function ($query) use ($dateFilter) {
                                    if($dateFilter[0] && $dateFilter[1]){
                                        $to = $dateFilter[0];
                                        $from =  $dateFilter[1];
                                        $query->whereBetween('date_created_transaction',[$to, $from]);
                                    }
                                })
                                ->paginate(20);
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