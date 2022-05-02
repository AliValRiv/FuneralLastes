<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Empresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DatatableController extends Controller
{
    public function cliente(){
        if(Auth::check()) {
            if(Auth::User()->priv == 'cl'){
                $clientes = DB::select('SELECT `clientes`.`id`,`empresas`.`nombre` as nombre_empresa,`clientes`.`empleado`,`clientes`.`paterno`,`clientes`.`materno`,`clientes`.`nombre`,`clientes`.`fecha_nacimiento`,CASE WHEN `clientes`.`activo` = true THEN "Activo" ELSE "Inactivo" END as estatus FROM `clientes` INNER JOIN `empresas` ON `clientes`.`empresa_id`=`empresas`.`id` WHERE `clientes`.`empresa_id`='.Auth::User()->company_id.'');
                /* $clientes = Cliente::select('clientes.id','empresas.nombre as nombre_empresa','clientes.empleado','clientes.paterno','clientes.materno','clientes.nombre','clientes.fecha_nacimiento','CASE WHEN clientes.activo = true THEN Activo ELSE Inactivo END as cliente_estatus')
                            ->join('empresas','clientes.empresa_id','=','empresas.id')
                            ->where('clientes.empresa_id', Auth::User()->company_id)->get(); */
                return datatables()->of($clientes)
                        ->addColumn('ver','<a href="{{ route(\'clientes.show\', $id) }}" class="btn btn-primary">'.('Ver').'</a>')
                        ->addColumn('status','<a href="{{ route(\'clientes.edit\', $id) }}" class="btn btn-info">'.('Estatus').'</a>')
                        ->rawColumns(['ver','status'])
                        ->toJson();
            }
            else { 
                $clientes = DB::select('SELECT `clientes`.`id`,`empresas`.`nombre` as nombre_empresa,`clientes`.`empleado`,`clientes`.`paterno`,`clientes`.`materno`,`clientes`.`nombre`,`clientes`.`fecha_nacimiento`,CASE WHEN `clientes`.`activo` = true THEN "Activo" ELSE "Inactivo" END as estatus FROM `clientes` INNER JOIN `empresas` ON `clientes`.`empresa_id`=`empresas`.`id`');
                //$clientes = Cliente::select('clientes.id','empresas.nombre as nombre_empresa','clientes.empleado','clientes.paterno','clientes.materno','clientes.nombre','clientes.fecha_nacimiento','CASE WHEN clientes.activo = true THEN 1 ELSE 2 END as cliente_estatus')
                            //->join('empresas','clientes.empresa_id','=','empresas.id')->get();
                return datatables()->of($clientes)
                                    ->addColumn('ver','<a href="{{ route(\'clientes.show\', $id) }}" class="btn btn-primary">'.('Ver').'</a>')
                                    ->addColumn('status','')
                                    ->rawColumns(['ver'])
                                    ->toJson();
            }
        }
    }
}
