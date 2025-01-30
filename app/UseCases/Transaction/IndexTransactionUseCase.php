<?php

namespace App\UseCases\Transaction;

use App\Repositories\Interfaces\TransactionInterfaceRepository;


class IndexTransactionUseCase{

    private TransactionInterfaceRepository $repository;

    public function __construct(TransactionInterfaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(){
        return $this->repository->all();
    }
}