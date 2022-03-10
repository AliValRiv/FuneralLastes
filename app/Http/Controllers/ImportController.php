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

            if($file->guessExtension()=="xlsx" or $file->guessExtension()=="xls" or $file->guessExtension()=="csv"){
                        try{
                        $clientes = Excel::toCollection(new ClientsImport, request()->file('file'));
                            
                            foreach($clientes as $cli){
                                foreach($cli as $row){
                                    //Cliente::where('empleado', $row['empleado'])->update([
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


                            /* ([
                                'paterno' => $row[1],
                                    'materno' => $row[2],
                                    'nombre' => $row[3],
                                    'genero' => $row[4],
                                    'fecha_nacimiento' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]),
                                    'fecha_inicio' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]),
                                    'fecha_fin' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7]),
                                    'curp' => $row[8],
                                    'rfc' => $row[9],
                                    'nss' => $row[10],
                                    'telefono' => $row[11],
                                    'email' => $row[12],
                                    'opc1' => $row[13],
                                    'opc2' => $row[14],
                                    'opc3' => $row[15],
                                    'opc4' => $row[16],
                                    'opc5' => $row[17],
                                    'opc6' => $row[18],
                                    'empresa_id' => Auth::User()->company_id,
                                    'activo' => true,
                            ]); */

                        //$cliente = Cliente::where('empleado','emp1003');
                        //$cliente = \DB::table('clientes')->select('paterno')->where('empleado',$row['empleado'])->get();
                        /* dd($cliente);
                            if ($cliente === null) {

                                return new Cliente([
                                    'empleado' => $row[0],
                                    'paterno' => $row[1],
                                    'materno' => $row[2],
                                    'nombre' => $row[3],
                                    'genero' => $row[4],
                                    'fecha_nacimiento' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]),
                                    'fecha_inicio' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]),
                                    'fecha_fin' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7]),
                                    'curp' => $row[8],
                                    'rfc' => $row[9],
                                    'nss' => $row[10],
                                    'telefono' => $row[11],
                                    'email' => $row[12],
                                    'opc1' => $row[13],
                                    'opc2' => $row[14],
                                    'opc3' => $row[15],
                                    'opc4' => $row[16],
                                    'opc5' => $row[17],
                                    'opc6' => $row[18],
                                    'empresa_id' => Auth::User()->company_id,
                                    'activo' => true,
                                ]);
                                echo var_dump($cliente);
                            }
                            else{
                                $cliente = Cliente::find($row[0]);
                                dd($cliente);

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
                                $cliente->opc6 = $row['opc6']; */
                    
                                /* $cliente->paterno = $row[1];
                                $cliente->materno = $row["materno"];
                                $cliente->nombre = $row["nombre"];
                                $cliente->genero = $row[4];
                                $cliente->fecha_nacimiento = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]);
                                $cliente->fecha_inicio = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]);
                                $cliente->fecha_fin = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7]);
                                $cliente->curp = $row[8];
                                $cliente->rfc = $row[9];
                                $cliente->nss = $row[10];
                                $cliente->telefono = $row[11];
                                $cliente->email = $row[12];
                                $cliente->opc1 = $row[13];
                                $cliente->opc2 = $row[14];
                                $cliente->opc3 = $row[15];
                                $cliente->opc4 = $row[16];
                                $cliente->opc5 = $row[17];
                                $cliente->opc6 = $row[18]; 
                                
                                $cliente->save();
                            } */
                        



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
                                ->withErrors("No es un archivo valido. Tiene que ser tipo xlsx, xls o csv.")
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