<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carga;
use App\Http\Requests\StoreCargaRequest;
use App\Http\Requests\UpdateCargaRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    }

    public function status(Request $request)
    {
        $carga = Carga::find($request->input('id'));
        $carga->status = $request->input('status');
        $carga->save();

        return back();
    }

    
}
