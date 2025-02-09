<?php

namespace App\UseCases\User;

use App\Repositories\Interfaces\UserInterfaceRepository;


class RegisterUseCase{

    private UserInterfaceRepository $repository;

    public function __construct(UserInterfaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $data){
        return $this->repository->create($data);
    }
}