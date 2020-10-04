tested on ubuntu 19.10lts
system required:-Docker [ >= 17.12 ]

-Download the project from git;
-enter into project folder--->enter into laradock subfolder;
-stop all http and mysql service on local machine;
-run "docker-compose up -d nginx mysql" for starting the app; 
-run "sudo docker-compose exec workspace bash" 
 and run "php artisan migrate", hit "exit";
-the servise is up and it can be tested with clients like:
POSTMAN:
set POST "localhost/api/SearchNearestPharmacy"  
and JSON as raw body:
{"jsonrpc":"2.0","method":"pharmacies@SearchNearestPharmacy","params":{"currentLocation": {"latitude": 41.10938993,"longitude":14.7554 },"range": 465464,"limit":3},"id" : 1}


&&&&&&&&&&&&&&&

CURL:

curl 'http://localhost/api/SearchNearestPharmacy' --data-binary '{"jsonrpc":"2.0","method":"pharmacies@SearchNearestPharmacy","params":{"currentLocation": {"latitude": 41.10938993,"longitude": 14.7554},"range": 5000,"limit": 3},"id" : 1}'


***********************************************

NOTES:
the rpc call accept only well formed json data.
Error handling for rpc needs improve,
