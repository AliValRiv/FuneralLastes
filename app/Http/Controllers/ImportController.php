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
use Illuminate\Support\Facades\Validator;
use Exceptions;
  
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
                Excel::import(new ClientsImport,request()->file('file'));
                //Excel::queueImport(new ClientsImport,request()->file('file'));
                try{
                    Excel::queueImport(new ClientsImport,request()->file('file'));
                }     
                catch(\InvalidArgumentException $ex){
                    return redirect('dashboard')
                            ->withErrors("Existe un error en los datos.")
                            ->withInput();
                }
                catch(\Error $ex){
                    return redirect('dashboard')
                            ->withErrors("Existe un error columnas de fechas.")
                            ->withInput();
                }
                catch(\ErrorException $ex){
                    return redirect('dashboard')
                            ->withErrors("Existe un error columnas de fechas. Verificar formato.")
                            ->withInput();
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
                $carga->tipo = 'a';
                $carga->status = false;
                $carga->observaciones = 'El archivo se cargó correctamente.';

                $carga->save();
                    
                return redirect()->route('dashboard')->with( ['message'=>'Se importaron o modificaron los registros correctamente.','message_type'=>'success']); 
                
            }
            else{
                return redirect('dashboard')
                        ->withErrors("No es un archivo valido. Tiene que ser tipo xlsx o xls.")
                        ->withInput();
            }
        }
    }
}