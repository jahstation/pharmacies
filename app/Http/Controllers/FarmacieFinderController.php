<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Exception;
use App\Http\Controllers\GeoUtils;
use App\Http\Controllers\dbFunction;
use App\Models\Farmacie;
use App\Http\Procedures\PharmaciesProcedure;




class FarmacieFinderController extends Controller
{


    public function prepareOut($data){
        $farmacieResults=$data;
        foreach($farmacieResults as $farmaciaResult){
                                    $pharmacies[]=[ 'name'=>$farmaciaResult->name,
                                                    'distance'=>$farmaciaResult->distance,
                                                    'location'=>[   'latitude'=>$farmaciaResult->latitude,
                                                                    'longitude'=>$farmaciaResult->longitude
                                                    ]
                                                ]; 
        }
        $out=['pharmacies'=>$pharmacies];
        return $out;
        }
        
        public function searchNearestPharmacies($request){
        
              $latUser=$request->input('currentLocation')['latitude'];
              $longUser=$request->input('currentLocation')['longitude'];
              $range=$request->input('range');
              if($request->input('limit')){
                  $limit=$request->input('limit');
              }else{
                  $limit=null;
              } 
              $geox= new GeoUtils;
              $dbUtils= new dbFunction;
              $farmaciesList= $geox->getFilePharmacies();
              if(!$farmaciesList){
                  return "errorBuildingDb";
                  }
              $dbUtils->insertFarmacie($farmaciesList);
            
              $farmacieResults=$geox->rangeCalc($latUser, $longUser,$range,$limit);
              if($farmacieResults){
                        $sendingData=$this->prepareOut($farmacieResults);
              }else{

                    return 'no Results';              
                  }                
              $dbUtils->truncateFarmacie();
              return $sendingData;             
              
    }
}
