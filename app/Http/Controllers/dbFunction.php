<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\FarmacieController;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Farmacie;




class dbFunction  
{
    public function truncateFarmacie(){
        DB::table('farmacie')->truncate(); 
        }
    
    function insertFarmacie($farmacieList){      
      
        
        foreach(json_decode($farmacieList)->features as $farmacia){                        
                        
                        if ($farmacia->properties->Descrizione){
                            $nome=$farmacia->properties->Descrizione;
                        }else{
                              $nome='unknow';  
                        }                        
                        if ($farmacia->geometry->coordinates[1]){
                            $lat=$farmacia->geometry->coordinates[1];
                        }else{
                              $lat=0;  
                        }
                        if ($farmacia->geometry->coordinates[0]){
                            $long=$farmacia->geometry->coordinates[0];
                        }else{
                              $long=0;  
                        } 
                        
                        $farmacieExport[]= ['name'=>$nome,'latitude'=>$lat, 'longitude'=>$long];
                    }
        $farmacieInsert = new FarmacieController;                        
        $farmacieInsert->storeIfNotExist($farmacieExport);
        }
    

    
    
}
