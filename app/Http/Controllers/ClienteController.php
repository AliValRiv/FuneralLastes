<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

use App\Models\Carga;
use App\Http\Requests\StoreCargaRequest;
use App\Http\Requests\UpdateCargaRequest;
use App\Models\User;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) {
            if(Auth::User()->priv == 'cl'){
                $clientes = Cliente::where('empresa_id', Auth::User()->company_id)->get();
                return view('clientes.index', compact('clientes'));
            }
            else {
                //$clientes = Cliente::all();
                $clientes = Cliente::where('activo',1)
                    ->select('id','empresa_id','empleado','paterno','materno','nombre','fecha_nacimiento','estatus')->get();
                return view('clientes.index', compact('clientes'));
            }
        }
  
        return redirect("login")->withSuccess('No se permitió el acceso');
    }

    /**
     * Show the form for creating a new resource.
     *
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cliente::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        return view ('clientes.show', ['cliente'=>$cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente->activo == true) {
            $cliente->activo = false;
        } 
        else {
            $cliente->activo = true;
        }
        $cliente->save();

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function otorgarserv(Request $request)
    {
        $cliente = Cliente::find($id);
        if ($cliente->estatus === true) {
            $cliente->estatus = false;
            $cliente->otorgado = Carbon::createFromFormat('d/m/Y', $request['otorgado']);
            $cliente->save();
        } 

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $cliente = Cliente::find($id);
        //dd($cliente);

        $cliente->fill($request->all())->save();

        return back();
    }

    /**
     * Update the STATUS resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $cliente = Cliente::find($id);
        $cliente->activo = false;
        $cliente->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
