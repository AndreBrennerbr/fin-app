<?php

namespace App\Use_cases\Transaction;

use App\Repositories\Interfaces\TransactionInterfaceRepository;
use App\Repository\TransactionRepository;

class StoreTransactionUseCase{

    private TransactionInterfaceRepository $repository;

    public function __construct(TransactionInterfaceRepository $repository)
    {
        $this->repository = $repository;
    }


    public function execute(array $data){
        //Do logica

        return $this->repository->create($data);
    }


}