<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\DB;
use App\Models\Farmacie;


use Exception;




class GeoUtils  
{
    

    //to be impl
    public function getAdress($lat, $long){
    
        $response = Http::get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='.$lat.'&lon='.$long);
        return $response;

    }
    
    
    
    function getFilePharmacies(){
        try{
            $response = Http::timeout(1)->get('https://dati.regione.campania.it/catalogo/resources/Elenco-Farmacie.geojson');
            if($response->successful()){
                    $farmaciesList=$response->body();
            }else{
                   $farmaciesList=file_get_contents(storage_path('app/public/pharmaciesList.json'));
  
            }           
            return $farmaciesList;
          }catch (Exception $ex) {
             return  file_get_contents(storage_path('app/public/pharmaciesList.json'));

        }
        
    }
    
    public function rangeCalc($lat,$lon,$distance,$limit){
        
            $query=" 
                        SELECT
                        name,latitude,longitude, ROUND((
                        6371392.8969 * 
                            ACOS( 
                                COS( RADIANS( latitude ) ) * 
                                COS( RADIANS( $lat ) ) * 
                                COS( RADIANS( $lon ) - 
                                RADIANS( longitude ) ) + 
                                SIN( RADIANS( latitude ) ) * 
                                SIN( RADIANS( $lat) ) 
                            ) 
                        ) )
                        AS distance
                        FROM farmacie 
                        HAVING distance <= $distance ORDER BY distance ASC";
                        
            if($limit){
                        $query.=" LIMIT $limit";
            }
        
        $farmacieNelRaggio = DB::select($query); 
        return $farmacieNelRaggio;
        }
}
