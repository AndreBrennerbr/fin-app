<?php

namespace App\UseCases\Transaction;

use App\Repositories\Interfaces\TransactionInterfaceRepository;


class TransactionUseCase{

    private TransactionInterfaceRepository $repository;

    public function __construct(TransactionInterfaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(null|array $params = null){
        try {
            return $this->repository->all($params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getById(int $id){
        try {
            return $this->repository->findById($id);
        } catch (\RuntimeException $e) {
            throw $e;
        }
    }

    public function create(array $data){
        try {
            return $this->repository->create($data);
        } catch (\RuntimeException $e) {
            throw $e;
        }
    }

    public function update(int $id ,array $data){
        try {
            return $this->repository->update($id,$data);
        } catch (\RuntimeException $e) {
            throw $e;
        }
    }
}