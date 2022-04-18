<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;

class DatatableController extends Controller
{
    public function cliente(){
        if(Auth::check()) {
            if(Auth::User()->priv == 'cl'){
                $clientes = Cliente::select('clientes.id','empresas.nombre as nombre_empresa','clientes.empleado','clientes.paterno','clientes.materno','clientes.nombre','clientes.fecha_nacimiento','clientes.fecha_inicio','clientes.fecha_fin')
                            ->join('empresas','clientes.empresa_id','=','empresas.id')
                            ->where('clientes.activo', true)
                            ->where('clientes.empresa_id', Auth::User()->company_id)->get();
                return datatables()->of($clientes)
                        ->addColumn('ver','<a href="{{ route(\'clientes.show\', $id) }}" class="btn btn-primary">'.('Ver').'</a>')
                        ->addColumn('status','<a href="{{ route(\'clientes.edit\', $id) }}" class="btn btn-warning">'.('Inactivar').'</a>')
                        ->rawColumns(['ver','status'])
                        ->toJson();
            }
            else { 
                $clientes = Cliente::select('clientes.id','empresas.nombre as nombre_empresa','clientes.empleado','clientes.paterno','clientes.materno','clientes.nombre','clientes.fecha_nacimiento','clientes.fecha_inicio','clientes.fecha_fin')
                            ->join('empresas','clientes.empresa_id','=','empresas.id')
                            ->where('clientes.activo', true)->get();
                return datatables()->of($clientes)
                                    ->addColumn('ver','<a href="{{ route(\'clientes.show\', $id) }}" class="btn btn-primary">'.('Ver').'</a>')
                                    ->addColumn('status','')
                                    ->rawColumns(['ver'])
                                    ->toJson();
            }
        }
    }
}
