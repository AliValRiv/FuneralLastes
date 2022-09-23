<?php

namespace App\Imports;

use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Group;
use App\User;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;
use Illuminate\Contracts\Queue\ShouldQueue;
//use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;


use Carbon\Carbon;

class ClientsImport implements ToModel, WithUpserts, WithHeadingRow, WithValidation,  WithChunkReading//, ShouldQueue //WithBatchInserts,
{
    use Importable;
    //private $numRows = 0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            return new Cliente([
                'empleado' => $row['empleado'],
                'empresa_id' => Auth::User()->company_id,
                'paterno' => $row['paterno'],
                'materno' => $row['materno'],
                'nombre' => $row['nombre'],
                'genero' => $row['genero'],
                'fecha_nacimiento' => Carbon::createFromFormat('Y/m/d',$row['fecha_nacimiento']),
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
                'activo' => true,
            ]);
    }

    public function uniqueBy()
    {
        return 'unique_index';
    }
 
    public function rules(): array
    {
        return [
            'empleado' => 'required|distinct:strict|max:100',
            'paterno' => 'required|max:255',
            'materno' => 'nullable|max:255',
            'nombre' => 'required|max:255',
            'genero' => 'nullable|max:1',
            'fdn' => 'nullable|date_format:d/m/Y',
            'fdi' => 'nullable|date_format:d/m/Y',
            'fdf' => 'nullable|date_format:d/m/Y',
            'curp' => 'nullable|max:18',
            'rfc' => 'nullable|max:13',
            'nss' => 'nullable|max:15',
            'telefono' => 'nullable|max:10',
            'email' => 'nullable|max:100',
            'opc1' => 'nullable|max:255',
            'opc2' => 'nullable|max:255',
            'opc3' => 'nullable|max:255',
            'opc4' => 'nullable|max:255',
            'opc5' => 'nullable|max:255',
            'opc6' => 'nullable|max:255',
        ];
        
    }
    
   /*  public function batchSize(): int
    {
        return 1000;
    } */

    public function chunkSize(): int
    {
        return 1000;
    }

    /* public function dateColumns(): array
    {
        try{
        return [['fecha_nacimiento' => 'd/m/Y', 'fdn'],['fecha_inicio' => 'd/m/Y', 'fdi'],['fecha_fin' => 'd/m/Y', 'fdf']];
        }
        catch(\ErrorException $e){
            return back()->withError($e)->withInput();
        }
        catch(\Error $e){
            return back()->withError($e)->withInput();
        }
        catch(\InvalidArgumentException $e){
            return back()->withError($e)->withInput();
        }
        catch(\TypeError $e){
            return back()->withError($e)->withInput();
        }
    } */
 
    public function getRowCount(): int
    {
        return $this->numRows;
    }

    public function mform()
    {
        return view('mform');
    }
}