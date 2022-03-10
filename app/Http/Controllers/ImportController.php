<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Carga;
use App\Http\Requests\StoreCargaRequest;
use App\Models\User;
use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Imports\ClientsDelete;
  
class ImportController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
       return view('dashboard');
    }
   
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        $contador = 0;
        if($request->hasFile("file")){

            $file=$request->file("file");

            if($file->guessExtension()=="xlsx" or $file->guessExtension()=="xls" /* or $file->guessExtension()=="csv" */){
                try{
                    $clientes = Excel::toCollection(new ClientsImport, request()->file('file'));
                        
                        foreach($clientes as $cli){
                            foreach($cli as $row){
                                $cliente = Cliente::updateOrCreate(['empleado' => $row['empleado'],'empresa_id' => Auth::User()->company_id,],[
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
                                    'opc6' => $row['opc6'],
                                    'opc6' => $row['opc6'],
                                    'activo' => true,
                                    ]
                                );
                                $contador++;
                            }
                        }

                        $nombre = $request->input('email').'_'.date('Y-m-d_H-i-s')."_alta.".$file->guessExtension();
                        $ruta = public_path("cargas/".$nombre);
                        copy($file, $ruta);

                        $carga = new Carga();

                        $carga->fecha_carga = date('Y/m/d');
                        $carga->archivo = $nombre;
                        $carga->usuario = (int)$request->input('user_id');
                        $carga->comentarios = $request->input('comentarios');
                        $carga->company_id = (int)$request->input('empresa_id');
                        $carga->status = true;
                        $carga->tipo = 'a';

                        $carga->save();
                
                            
                        return redirect()->route('dashboard')->with( ['message'=>'Se importaron o modificaron '.$contador." registros correctamente.",'message_type'=>'success']); 
                    
                }    
                catch(Exception $e){
                    return redirect('dashboard')
                            ->withErrors("No es un archivo valido. Tiene que ser tipo xlsx o xls.")
                            ->withInput();
                }
            }

            else{
                return redirect('dashboard')
                        ->withErrors("No es un archivo valido. Tiene que ser tipo xlsx, xls o csv.")
                        ->withInput();
            }
        }

    }
}