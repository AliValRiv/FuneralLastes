<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\Facades\Excel;
  
class ImportController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
       return view('import');
    }
   
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new ClientsImport, request()->file('file'));
           
        return back(); 

    }
}