<?php

namespace App\Imports;

use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ClientsImport implements ToModel, WithHeadingRow, WithValidation
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
            'paterno' => $row['paterno'],
            'materno' => $row['materno'],
            'nombre' => $row['nombre'],
            'genero' => $row['genero'],
            'fecha_nacimiento' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_nacimiento']),
            'fecha_inicio' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_inicio']),
            'fecha_fin' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_fin']),
            'curp' => $row['curp'],
            'rfc' => $row['rfc'],
            'nss' => $row['nss'],
            'telefono' => $row['telefono'],
            'email' => $row['email'],
            'opc1' => $row['opc1'],
            'opc2' => $row['opc2'],
            'opc3' => $row['opc3'],
            'opc4' => $row['opc4'],
            'opc5' => $row['opc5'],
            'opc6' => $row['opc6'],
            'empresa_id' => Auth::User()->company_id,
            'activo' => true,
        ]);
        
    }
 
    public function rules(): array
    {
        return [
            'empleado' => 'required|unique:clientes,empleado|max:100',
            'paterno' => 'required|max:255',
            'materno' => 'nullable|max:255',
            'nombre' => 'required|max:255',
            'genero' => 'nullable|max:1',
            'fecha_nacimiento' => 'nullable',
            'fecha_inicio' => 'nullable',
            'fecha_fin' => 'nullable',
            'curp' => 'nullable|max:18',
            'rfc' => 'nullable|max:13',
            'nss' => 'nullable|max:15',
            'telefono' => 'nullable|max:10',
            'email' => 'nullable|email|max:100',
            'opc1' => 'nullable|max:255',
            'opc2' => 'nullable|max:255',
            'opc3' => 'nullable|max:255',
            'opc4' => 'nullable|max:255',
            'opc5' => 'nullable|max:255',
            'opc6' => 'nullable|max:255',
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