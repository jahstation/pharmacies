<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farmacie;
use Illuminate\Support\Facades\DB;

class FarmacieController extends Controller
{
    //
    
    public function storeIfNotExist($farmacie)
    {
        $farms= array();
        $value = reset($farmacie);
            while ($value!==false){                
                if(!Farmacie::where('name', '=', $value['name'])->exists()){
                    $farms[]=$value;
                }
                next($farmacie); 
                $value = current($farmacie);
            }
            
            DB::table('farmacie')->insert($farms);          
    }
    
  
}
