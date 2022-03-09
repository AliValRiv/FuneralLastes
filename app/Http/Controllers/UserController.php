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

        $num =  $request->input('company_id');

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->company_id = (int)$num;
        $user->admin = false;
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
        $user->priv = $request->input('priv');
        $user->save();        
        $newpass = $request->input('password');
        if ($newpass != ''){
        $user->password = Hash::make($newpass);
        $user->save();
        }

        return back();
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

        return back()->with( ['message'=>'Operación realizada correctamente.','message_type'=>'info']);
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
