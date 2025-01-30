<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUser;
use App\UseCases\User\UserUseCase;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    private UserUseCase $register; 

    public function __construct(UserUseCase $register)
    {
        $this->register =  $register;
    }

    public function login(LoginRequest $request)
    {   try {
            $validatedData = $request->validated();
            return $this->register->login($validatedData);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage()
           ], 400);
        }catch(\Exception $e){
            return response()->json(['erro' => 'Erro inesperado, entre em contato com o administrador'], 500);
        }
        
    }


    public function logout(Request $request){
        try {
            return $this->register->logout($request);
        }catch(\Exception $e){
            return response()->json(['erro' => 'Erro inesperado, entre em contato com o administrador'], 500);
        }
    }

    
    public function register(RegisterUser $request)
    {   
        try{
            $validatedData = $request->validated();
            return $this->register->register($validatedData);
        }catch(\Exception $e){
            return response()->json(['erro' => 'Erro inesperado, entre em contato com o administrador'], 500);
        }
    }

}
