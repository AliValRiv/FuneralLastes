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
        /* 
        $cliente = Cliente::where('empleado', $row['empleado'])->first();
 
        if ($cliente === null) {

            return ([
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
            echo var_dump($cliente);
        }
        else{
            $cliente = Cliente::find($row['empleado']);
 
            $cliente->paterno = $row['paterno'];
            $cliente->materno = $row['materno'];
            $cliente->nombre = $row['nombre'];
            $cliente->genero = $row['genero'];
            $cliente->fecha_nacimiento = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_nacimiento']);
            $cliente->fecha_inicio = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_inicio']);
            $cliente->fecha_fin = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_fin']);
            $cliente->curp = $row['curp'];
            $cliente->rfc = $row['rfc'];
            $cliente->nss = $row['nss'];
            $cliente->telefono = $row['telefono'];
            $cliente->email = $row['email'];
            $cliente->opc1 = $row['opc1'];
            $cliente->opc2 = $row['opc2'];
            $cliente->opc3 = $row['opc3'];
            $cliente->opc4 = $row['opc4'];
            $cliente->opc5 = $row['opc5'];
            $cliente->opc6 = $row['opc6'];
             
            $cliente->save();
        } */

        //$user = User::firstOrCreate(['name' => 'John Doe']);
        
        /* return Cliente::firstOrCreate([
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
            'activo' => true,]); */

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

    /* public function mguardar(Request $request)
    {
        if($request->hasFile("file")){
            $file=$request->file("file");
            
            $nombre = $request->input('email').'_'.date('Y-m-d_H-i-s')."_alta.".$file->guessExtension();

            $ruta = public_path("cargas/".$nombre);

            if($file->guessExtension()=="xlsx" or $file->guessExtension()=="xls" or $file->guessExtension()=="csv"){
                copy($file, $ruta);
                $carga = new Carga();

                $carga->fecha_carga = date('Y/m/d');
                $carga->archivo = $nombre;
                $carga->usuario = (int)$request->input('user_id');
                $carga->comentarios = $request->input('comentarios');
                $carga->company_id = (int)$request->input('empresa_id');
                $carga->tipo = 'a';

                $carga->save();
            }else{
                return redirect('dashboard')
                        ->withErrors("No es un archivo valido. Tiene que ser tipo xlsx, xls o csv.")
                        ->withInput();
            }
            return back();
        }
    }

    public function mguardarbajas(Request $request)
    {
        if($request->hasFile("file")){
            $file=$request->file("file");
            
            $nombre = $request->input('email').'_'.date('Y-m-d_H-i-s')."_baja.".$file->guessExtension();

            $ruta = public_path("cargas/".$nombre);

            if($file->guessExtension()=="xlsx" or $file->guessExtension()=="xls" or $file->guessExtension()=="csv"){
                copy($file, $ruta);
                $carga = new Carga();

                $carga->fecha_carga = date('Y/m/d');
                $carga->archivo = $nombre;
                $carga->usuario = (int)$request->input('user_id');
                $carga->comentarios = $request->input('comentarios');
                $carga->company_id = (int)$request->input('empresa_id');
                $carga->tipo = 'b';

                $carga->save();
            }else{
                return redirect('dashboard')
                        ->withErrors("No es un archivo valido. Tiene que ser tipo xlsx, xls o csv.")
                        ->withInput();
            }
            return back();
        }
    } */

}