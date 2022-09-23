<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Carga;
use Illuminate\Support\Facades\Auth;
use Exception;
use Twilio\Rest\Client;
use DB;


class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }  
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::User()->activo) {
            
                $receiverNumber = '+52'. Auth::User()->mobile;
                $tfaToken = rand(1000,9999);
                $message = "El código de seguridad para FuneralNet es: ".$tfaToken;

                Auth::User()->tfaToken = $tfaToken;
                Auth::User()->verified = false;
                Auth::User()->save();
            
                try {
            
                    $account_sid = getenv("TWILIO_SID");
                    $auth_token = getenv("TWILIO_TOKEN");
                    $twilio_number = getenv("TWILIO_FROM");
            
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create($receiverNumber, [
                        'from' => $twilio_number,
                        'body' => $message]);
                } catch (Exception $e) {
                }

                return view('auth.verification');
            }
        }
  
        return redirect("login")->withErrors('Usuario o contraseña incorrectos');
    }

    public function verification(Request $request)
    {
        $request->validate([
            'ver_code' => 'required',
        ]);
   
        $tfaToken = $request->input('ver_code');

        if (Auth::User()->tfaToken == $tfaToken) {
            Auth::User()->verified = true;
            Auth::User()->save();

            return redirect()->intended('dashboard')->withSuccess('Verificación exitosa.');
        }

        Session::flush();
        Auth::logout();
        
        return redirect("login")->withErrors('Código de verificación incorrecto');
    }

    public function registration()
    {
        return view('auth.registration');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function dashboard()
    {
         if(Auth::check()) {
            if (Auth::User()->verified) {
                if(Auth::User()->priv == 'cl' && Auth::User()->company_id != 1){
                    $cargas = Carga::where('company_id', Auth::User()->company_id)->get();
                    $tot = DB::table('clientes')
                        ->where('empresa_id', Auth::User()->company_id)
                        ->count();
                    $act = DB::table('clientes')
                        ->where('empresa_id', Auth::User()->company_id)
                        ->where('activo', true)
                        ->count();
                    $ina = DB::table('clientes')
                        ->where('empresa_id', Auth::User()->company_id)
                        ->where('activo', false)
                        ->count();   
                        // dd("Totales: ".$tot."  Activos: ".$act."  Inactivos: ".$ina);
                    return view('dashboard', ['cargas' => $cargas , 'tot' => $tot , 'act' => $act , 'ina' => $ina]);
                }
                else {
                    $cargas = Carga::all();
                    return view('dashboard', ['cargas' => $cargas]);
                }
            }
            
            Session::flush();
            Auth::logout();
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}