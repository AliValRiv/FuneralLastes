<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;

class RegistresController extends Controller
{
    public function nuevoRegistro (Request $request) {
        if(Auth::user()->priv === "cl") {
            $validator = Validator::make($request->all(), [
                'empleado' => 'required|max:100',
                'paterno' => 'required|max:255',
                'materno' => 'nullable|max:255',
                'nombre' => 'required|max:255',
                'genero' => 'nullable|max:1',
                'fecha_nacimiento' => 'nullable|date_format:d/m/Y',
                'fecha_inicio' => 'nullable|date_format:d/m/Y',
                'fecha_fin' => 'nullable|date_format:d/m/Y',
                'curp' => 'nullable|max:18',
                'rfc' => 'nullable|max:13',
                'nss' => 'nullable|max:15',
                'telefono' => 'nullable|max:10',
                'email' => 'nullable|max:100',
                'opc1' => 'nullable|max:255',
                'opc2' => 'nullable|max:255',
                'opc3' => 'nullable|max:255',
                'opc4' => 'nullable|max:255',
                'opc5' => 'nullable|max:255',
                'opc6' => 'nullable|max:255',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }

            try {
                Cliente::create([
                    'empleado' => $request['empleado'],
                    'empresa_id' => Auth::User()->company_id,
                    'paterno' => $request['paterno'],
                    'materno' => $request['materno'],
                    'nombre' => $request['nombre'],
                    'genero' => $request['genero'],
                    'fecha_nacimiento' => Carbon::createFromFormat('d/m/Y', $request['fecha_nacimiento']),
                    'fecha_inicio' => Carbon::createFromFormat('d/m/Y', $request['fecha_inicio']),
                    'fecha_fin' => Carbon::createFromFormat('d/m/Y', $request['fecha_fin']),
                    'curp' => $request['curp'],
                    'rfc' => $request['rfc'],
                    'nss' => $request['nss'],
                    'telefono' => $request['telefono'],
                    'email' => $request['email'],
                    'opc1' => $request['opc1'],
                    'opc2' => $request['opc2'],
                    'opc3' => $request['opc3'],
                    'opc4' => $request['opc4'],
                    'opc5' => $request['opc5'],
                    'opc6' => $request['opc6'],
                    'activo' => true,
                    'estatus' => true,
                    'entregado' => null,
                ]);

                return response()->json('Registro añadido correctamente',200);
            }
            catch(\Illuminate\Database\QueryException $ex) {
                return response()->json('El registro no se puede duplicar ',400);
            }
        }
        return response()->json('El usuario no es cliente ',400);

    }

    public function estatusRegistro (Request $request) {
        $info = DB::table('clientes')
            ->select('estatus','otorgado')
            ->where('empleado',$request->empleado)
            ->where('empresa_id',Auth::user()->company_id)->get();
        //return $info[0]->estatus;
        if ($info[0]->estatus === 0){
            return response()->json('Otorgado el '.$info[0]->otorgado,200);
        }
        if ($info[0]->estatus === 1){
        return response()->json('Sin otorgar',200);
        }

        return response()->json('No encontrado',400);

    }
}
