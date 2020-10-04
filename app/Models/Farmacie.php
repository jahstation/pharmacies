<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;

class Farmacie extends Model
{
    use  Geographical;
    use HasFactory;
        protected $table = 'farmacie';
        protected static $kilometers = true;


}
