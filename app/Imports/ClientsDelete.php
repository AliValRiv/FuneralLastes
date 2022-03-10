<?php

namespace App\Imports;

use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ClientsDelete implements ToModel, WithHeadingRow, WithValidation
{
    private $numRows = 0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->numRows;
        

        return new Cliente([
            'empleado' => $row['empleado'],
        ]);
        
    }
 
    public function rules(): array
    {
        return [
            'empleado' => 'required|unique:clientes,empleado|max:100',
            
        ];
    }
 
    public function getRowCount(): int
    {
        return $this->numRows;
    }

    public function mform()
    {
        return view('mform');
    }

}