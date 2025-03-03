<?php
namespace App\Factories;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportFactory{
    public static function import($type):ToModel{
        $types = config('typesImportExcel');
        if(!isset($types[$type]))
            throw new \InvalidArgumentException("Erro ao importar planilha: tipo inválido ({$type})");

        return new $types[$type]();
    }
}