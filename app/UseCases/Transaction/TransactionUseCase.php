<?php

namespace App\UseCases\Transaction;

use App\Repositories\Interfaces\TransactionInterfaceRepository;


class TransactionUseCase{

    private TransactionInterfaceRepository $repository;

    public function __construct(TransactionInterfaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(){
        return $this->repository->all();
    }

    public function getById(int $id){
        return $this->repository->findById($id);
    }

    public function create(array $data){
        return $this->repository->create($data);
    }

    public function update(int $id ,array $data){
        return $this->repository->update($id,$data);
    }
}