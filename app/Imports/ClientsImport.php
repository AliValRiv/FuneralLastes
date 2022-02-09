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
            'curp' => $row['curp'],
            'rfc' => $row['rfc'],
            'nss' => $row['nss'],
            'telefono' => $row['telefono'],
            'email' => $row['email'],
            'fecha_inicio' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_inicio']),
            'fecha_fin' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_fin']),
            'empresa_id' => Auth::User()->company_id,
            'activo' => true,
        ]);
 
    }
 
    public function rules(): array
    {
        return [
            'empleado' => 'required|max:100',
            'nombre' => 'required|max:255',
            'paterno' => 'required|max:255',
            'materno' => 'required|max:255',
            'genero' => 'required|max:1',
            'fecha_nacimiento' => 'required',
            'curp' => 'nullable|max:18',
            'rfc' => 'nullable|max:13',
            'nss' => 'nullable|max:15',
            'telefono' => 'nullable|max:10',
            'email' => 'nullable|email|max:100',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ];
    }
 
    public function getRowCount(): int
    {
        return $this->numRows;
    }
}