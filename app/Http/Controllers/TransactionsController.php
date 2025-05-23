<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionPost;
use App\Http\Requests\UpdateTransaction;
use App\Http\Requests\UploadFileRequest;
use App\UseCases\Transaction\TransactionUseCase;
use App\Factories\ImportFactory;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    public function index(request $request)
    {   
        try {
            $dateFilter = [$request->query('to'),$request->query('from')];
            $params = $request->only(['category', 'type','value','description','date_created_transaction']);
            return $this->TransactionUseCase->getAll($params, $dateFilter);
        }catch(\Illuminate\Validation\ValidationException $e){
            return response()->json([
                'erro' => 'Dados inválidos',
                'messages' => $e->errors()
            ],400);
        }catch (\RuntimeException $e) {
            Log::error('Erro: '. $e->getMessage() . " User: " .  Auth::id());
            return response()->json([
                    'message' => $e->getMessage()
            ], 500);
        }catch(\Exception $e){
            Log::error('Erro: '. $e->getMessage() . " User: " .  Auth::id());
            return response()->json(['erro' => 'Erro inesperado, entre em contato com o administrador'], 500);
        }
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionPost $request)
    { 
        try {
            $validatedData = $request->validated();
            return $this->TransactionUseCase->create($validatedData);
        }catch (\RuntimeException $e) {
            Log::error('Erro: '. $e->getMessage() . " User: " .  Auth::id());
           return response()->json([
                'message' => $e->getMessage()
           ], 500);
        }catch(\Exception $e){
            Log::error('Erro: '. $e->getMessage() . " User: " .  Auth::id());
            return response()->json(['erro' => 'Erro inesperado, entre em contato com o administrador'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
           return $this->TransactionUseCase->getById($id);
        }catch (\RuntimeException $e) {
            Log::error('Erro: '. $e->getMessage() . " User: " .  Auth::id());
            return response()->json([
                    'message' => $e->getMessage()
            ], 500);
        }catch(\Exception $e){
            Log::error('Erro: '. $e->getMessage() . " User: " .  Auth::id());
            return response()->json(['erro' => 'Erro inesperado, entre em contato com o administrador'], 500);
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaction $request, int $id)
    {
        try {
            $validatedData = $request->validated();
            return $this->TransactionUseCase->update($id,$validatedData);
        }catch (\RuntimeException $e) {
            Log::error('Erro: '. $e->getMessage() . " User: " .  Auth::id());   
            return response()->json([
                    'message' => $e->getMessage()
            ], 500);
        }catch(\Exception $e){
            Log::error('Erro: '. $e->getMessage() . " User: " .  Auth::id());
            return response()->json(['erro' => 'Erro inesperado, entre em contato com o administrador'], 500);
        }
    }

    public function excelUpload(UploadFileRequest $request){
        $file = $request->file('file');
        $type = $request->input('type');
        try {
            $importMethod = ImportFactory::import($type);
            Excel::import($importMethod, $file);
            return response()->json([
                'message' => 'Importado com sucesso!'
           ], 200);
        } catch (\Exception $e) {
            Log::error('Erro: '. $e->getMessage() . " User: " .  Auth::id());
            return response()->json(['erro' => 'Erro inesperado, entre em contato com o administrador'], 500);
        }
       
        
    }
}
