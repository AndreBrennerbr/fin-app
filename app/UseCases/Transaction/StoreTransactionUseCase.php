<?php

namespace App\UseCases\Transaction;

use App\Repositories\Interfaces\TransactionInterfaceRepository;


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