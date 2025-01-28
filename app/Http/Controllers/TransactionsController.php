<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionPost;
use App\Http\Requests\UpdateTransaction;
use App\Use_cases\Transaction\IndexTransactionUseCase;
use App\Use_cases\Transaction\ShowTransactionUseCase;
use App\Use_cases\Transaction\StoreTransactionUseCase;
use App\Use_cases\Transaction\UpdateTransactionUseCase;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    private IndexTransactionUseCase $index;
    private ShowTransactionUseCase $show;
    private StoreTransactionUseCase $store;
    private UpdateTransactionUseCase $update;

    public function __construct(
        IndexTransactionUseCase $indexUseCase,
        ShowTransactionUseCase $showUseCase,
        StoreTransactionUseCase $storeUseCase,
        UpdateTransactionUseCase $updateUseCase
    )
    {
        $this->index = $indexUseCase;
        $this->show = $showUseCase;
        $this->store = $storeUseCase;
        $this->update = $updateUseCase;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->index->execute();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionPost $request)
    {
        $validatedData = $request->validated();
        return $this->store->execute($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $this->show->execute($id);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaction $request, int $id)
    {
        $validatedData = $request->validated();
        return $this->update->execute($id,$validatedData);
    }
}
