<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::where('activo',true)->get();
        $users = User::all();
        return view('users.index', ['users' => $users, 'empresas'=> $empresas]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $user = new User();

        (int)$num =  $request->input('company_id');

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->company_id = $num;
        $user->admin = false;
        if ($num != '1'){
            $user->priv = 'cl';
        }
        elseif($num == '1' and $request->input('priv') == 'cl'){
            return back()->withErrors('Por ser de empresa Alciscorp, no puede seleccionar privilegios de cliente.');
        }
        else{
            $user->priv = $request->input('priv');
        }
        $user->password = Hash::Make($request->input('password'));

        $user->save();
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
        $user = User::find($id);
        $empresas = Empresa::where('activo',true)->get();

        return view ('users.show', ['user'=>$user, 'empresas'=> $empresas]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();

        return view ('users.profile', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user = User::find($id);

        //$user->fill($request->all())->save();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->company_id = $request->input('company_id');
        if ($request->input('company_id') != '1'){
            $user->priv = 'cl';
            $user->admin = false;
        }
        elseif($request->input('company_id') == '1' and $request->input('priv') == 'cl'){
            return back()->withErrors('Por ser de empresa Alciscorp, no puede seleccionar privilegios de cliente.');
        }
        else{
            if($request->input('priv') == 'ad'){
                $user->priv = $request->input('priv');
                $user->admin = true;
            }
            else{
                $user->priv = $request->input('priv');
                $user->admin = false;
            }
        }
        $user->save();        
        $newpass = $request->input('password');
        if ($newpass != ''){
        $user->password = Hash::make($newpass);
        $user->save();
        }

        return redirect('users')->with( ['message'=>'Actualizaci??n realizada correctamente.','message_type'=>'success']);
    }

    /**
     * Same User Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'confirmed', 
            Password::min(8)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()],
        ]);
        
        if ($validator->fails()) {
            return redirect('users/profile')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = Auth::User();

        $user->name = $request->input('name');
        $user->password = Hash::Make($request->input('password'));

        $user->save();

        return back()->with( ['message'=>'Operaci??n realizada correctamente.','message_type'=>'info']);
    }

    /**
     * Update the STATUS resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->activo = $request->input('status');
        $user->save();

        return back();
    }

    public function disableuser(Request $request)
    {
        $user = User::find($request->input('company_id'));
        $user->activo = $request->input('status');
        $user->save();

        return back();
    }

    /**
     * Update the ADMIN resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permisos(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->admin = $request->input('admin');
        if($request->input('admin')==false){
            $user->priv = 'cc';
        }
        if($request->input('admin')==true){
            $user->priv = 'ad';
        }
        $user->save();

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
