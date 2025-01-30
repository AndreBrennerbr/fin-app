<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionPost;
use App\Http\Requests\UpdateTransaction;
use App\UseCases\Transaction\TransactionUseCase;

use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    private TransactionUseCase $TransactionUseCase;
    
    public function __construct(TransactionUseCase $TransactionUseCase)
    {
        $this->TransactionUseCase =  $TransactionUseCase;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->TransactionUseCase->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionPost $request)
    {
        $validatedData = $request->validated();
        return $this->TransactionUseCase->create($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $this->TransactionUseCase->getById($id);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaction $request, int $id)
    {
        $validatedData = $request->validated();
        return $this->TransactionUseCase->update($id,$validatedData);
    }
}
