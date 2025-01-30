<?php

namespace App\UseCases\User;

use App\Repositories\Interfaces\UserInterfaceRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;


class UserUseCase{

    private UserInterfaceRepository $repository;

    public function __construct(UserInterfaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function register(array $data){
        return $this->repository->create($data);
    }

    public function login(array $data){
        $user = $this->repository->findByEmail($data['email']);
        
        if (!$user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email ou senha incorreta.']
            ]);
        }
        
        $token = $user->createToken($data['email'].'Auth-Service')->plainTextToken; 
        
        return response()->json([
            'usuario' => $user->only(['name', 'email']),
            'token' => $token,
            'token_type' => 'Bearer'
        ], 200);
    }


    public function logout(Object $request){
        $request->user()->tokens()->delete();
        return response()->json(['mensagem' => 'Logout realizado com sucesso'], 200); 
    }
}