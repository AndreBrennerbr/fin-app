<?php

namespace App\Use_cases\Transaction;

use App\Repositories\Interfaces\TransactionInterfaceRepository;


class ShowTransactionUseCase{

    private TransactionInterfaceRepository $repository;

    public function __construct(TransactionInterfaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id){
        return $this->repository->findById($id);
    }
}