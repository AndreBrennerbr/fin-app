<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionPost;
use App\Http\Requests\UpdateTransaction;
use App\UseCases\Transaction\IndexTransactionUseCase;
use App\UseCases\Transaction\TransactionUseCase;
use App\UseCases\Transaction\ShowTransactionUseCase;
use App\UseCases\Transaction\StoreTransactionUseCase;
use App\UseCases\Transaction\UpdateTransactionUseCase;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    private IndexTransactionUseCase $index;
    private TransactionUseCase $TransactionUseCase;
    private ShowTransactionUseCase $show;
    private StoreTransactionUseCase $store;
    private UpdateTransactionUseCase $update;

    public function __construct(
        IndexTransactionUseCase $indexUseCase,
        ShowTransactionUseCase $showUseCase,
        StoreTransactionUseCase $storeUseCase,
        UpdateTransactionUseCase $updateUseCase,
        TransactionUseCase $TransactionUseCase
    )
    {
        $this->index = $indexUseCase;
        $this->show = $showUseCase;
        $this->store = $storeUseCase;
        $this->update = $updateUseCase;
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
