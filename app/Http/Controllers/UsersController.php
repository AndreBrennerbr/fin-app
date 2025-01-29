<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUser;
use App\Use_cases\User\RegisterUseCase;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    private RegisterUseCase $register; 

    public function __construct(RegisterUseCase $register)
    {
        $this->register =  $register;
    }
    
    public function register(RegisterUser $request)
    {
        $validatedData = $request->validated();
        return $this->register->execute($validatedData);
    }

}
