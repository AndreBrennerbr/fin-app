<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionPost;
use App\Http\Requests\UpdateTransaction;
use App\Use_cases\Transaction\IndexTransactionUseCase;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    private IndexTransactionUseCase $index;

    public function __construct(IndexTransactionUseCase $indexUseCase)
    {
        $this->index = $indexUseCase;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return dd($this->index->execute());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionPost $request)
    {
        $validatedData = $request->validated();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaction $request, string $id)
    {
        $validatedData = $request->validated();
    }
}
