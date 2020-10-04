<?php

declare(strict_types=1);

namespace App\Http\Procedures;
use Sajya\Server\Procedure;
use App\Http\Controllers\FarmacieFinderController;
use Validator;



use Illuminate\Http\Request;

class PharmaciesProcedure extends Procedure
{
    /**
     * The name of the procedure that will be
     * displayed and taken into account in the search
     *
     * @var string
     */
    public static string $name = 'pharmacies';


    /**
     * Execute the procedure.
     *
     * @param Request $request
     *
     * @return array|string|integer
     */
    public function handle(Request $request)
    {
        // write your code
    }

   
    
    public function sendNearestPharmacy($pharmaciesListReply){  

             
        return ;
        
        
        }
    
    public function SearchNearestPharmacy(Request $request)
    {
        
        $validatedData = Validator::make($request->all(),[
                                          'currentLocation.latitude' => 'required|numeric|not_in:0|between:-90,90',
                                          'currentLocation.longitude' => 'required|numeric|not_in:0|between:-180,180',
                                          'range' => 'required|numeric|not_in:0',
                                          'limit'=>'nullable|numeric|not_in:0'
                                          ]);   
                                          
       if ($validatedData->fails()){
            $response = [
                    'success' => false,
                    'message' => $validatedData->messages()
            ];
                return response()->json($response, 404);           
        }           

        
        $search= new FarmacieFinderController;
        return $search->searchNearestPharmacies($request);
        
        

        
    }
    
    /*
     * curl 'http://127.0.0.1:8000/api/SearchNearestPharmacy' --data-binary '{"jsonrpc":"2.0","method":"pharmacies@SearchNearestPharmacy","params":{"currentLocation": {"latitude": 41.10938993,"longitude": 15.0321010},"range": 5000,"limit": 2},"id" : 1}'
     * 
     *      * curl 'http://127.0.0.0/api/SearchNearestPharmacy' --data-binary '{"jsonrpc":"2.0","method":"pharmacies@SearchNearestPharmacy","params":{"currentLocation": {"latitude": 41.10938993,"longitude": 15.0321010},"range": 5000,"limit": 2},"id" : 1}'

     * 
     * "currentLocation": {"latitude": 41.10938993,"longitude": 15.0321010},"range": 5000,"limit": 2
     * */
}
