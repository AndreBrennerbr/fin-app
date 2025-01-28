<?php

namespace App\Use_cases\Transaction;

use App\Repositories\Interfaces\TransactionInterfaceRepository;


class UpdateTransactionUseCase{

    private TransactionInterfaceRepository $repository;

    public function __construct(TransactionInterfaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id ,array $data){
        return $this->repository->update($id,$data);
    }
}