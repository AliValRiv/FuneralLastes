<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Carga;
use App\Http\Requests\StoreCargaRequest;
use App\Models\User;
  
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
        if($request->hasFile("file")){

            $file=$request->file("file");

            if($file->guessExtension()=="xlsx" or $file->guessExtension()=="xls" or $file->guessExtension()=="csv"){
            
            Excel::import(new ClientsImport, request()->file('file'));



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


                    
            return redirect()->route('dashboard'); 
            
            }
            else{
                return redirect('dashboard')
                        ->withErrors("No es un archivo valido. Tiene que ser tipo xlsx, xls o csv.")
                        ->withInput();
            }
        }

    }
}