<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carga;
use App\Http\Requests\StoreCargaRequest;
use App\Http\Requests\UpdateCargaRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClientsDelete;
use App\Models\Cliente;

class CargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCargaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCargaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carga  $carga
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carga = Carga::find($id);

        return view ('cargas.show', ['carga'=>$carga]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carga  $carga
     * @return \Illuminate\Http\Response
     */
    public function edit(Carga $carga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCargaRequest  $request
     * @param  \App\Models\Carga  $carga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $carga = Carga::find($id);

        $carga->fill($request->all())->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carga  $carga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carga $carga)
    {
        //
    }

    public function mform()
    {
        return view('mform');
    }

    public function mguardar(Request $request)
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
                        ->withErrors("No es un archivo valido. Tiene que ser tipo xlsx o xls")
                        ->withInput();
            }
            return back();
        }
    }

    public function mguardarbajas(Request $request)
    {
        $contador = 0;
        if($request->hasFile("file")){
            $file=$request->file("file");
            
            $nombre = $request->input('email').'_'.date('Y-m-d_H-i-s')."_baja.".$file->guessExtension();

            $ruta = public_path("cargas/".$nombre);

            if($file->guessExtension()=="xlsx" or $file->guessExtension()=="xls"){
                
                $clientes = Excel::toCollection(new ClientsDelete, request()->file('file'));

                foreach($clientes as $cli){
                    foreach($cli as $row){
                        Cliente::where((string)'empleado',(string)$row['empleado'])->where('empresa_id',Auth::User()->company_id)->update(['activo' => false]);
                        $contador++;
                    }
                }


                copy($file, $ruta);
                $carga = new Carga();

                $carga->fecha_carga = date('Y/m/d');
                $carga->archivo = $nombre;
                $carga->usuario = (int)$request->input('user_id');
                $carga->comentarios = $request->input('comentarios');
                $carga->company_id = (int)$request->input('empresa_id');
                $carga->tipo = 'b';
                $carga->status = false;
                $carga->observaciones = 'Las bajas realizaron correctamente.';

                $carga->save();
            }else{
                return redirect('dashboard')
                        ->withErrors("No es un archivo valido. Tiene que ser tipo xlsx o xls.")
                        ->withInput();
            }
            return redirect()->route('dashboard')->with( ['message'=>'Se inactivaron '.$contador." registros correctamente.",'message_type'=>'alert']);
            //return back();
        }
    }

    public function status(Request $request)
    {
        $carga = Carga::find($request->input('id'));
        $carga->status = $request->input('status');
        $carga->save();

        return back();
    }

    
}
