<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Carga;
use Illuminate\Support\Facades\Auth;
use Exception;
use Twilio\Rest\Client;


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
                    //dd("Error: ". $e->getMessage());
                }

                return view('auth.verification');
            }
        }
  
        return redirect('login')->withSuccess('Login details are not valid');
    }

    public function verification(Request $request)
    {
        $request->validate([
            'digit_1' => 'required',
            'digit_2' => 'required',
            'digit_3' => 'required',
            'digit_4' => 'required',
        ]);
   
        $tfaToken = $request->input('digit_1') . $request->input('digit_2') . $request->input('digit_3') . $request->input('digit_4');

        if (Auth::User()->tfaToken == $tfaToken) {
            Auth::User()->verified = true;
            Auth::User()->save();

            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }

        Session::flush();
        Auth::logout();

        return redirect('login')->withSuccess('Login details are not valid');
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
                if(!Auth::User()->admin){
                    $cargas = Carga::where('company_id', Auth::User()->company_id)->get();
                    return view('dashboard', ['cargas' => $cargas]);
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