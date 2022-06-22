<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class News extends Model {

    protected $connection = 'mongodb';

    protected $collection = "hw2";

    public $timestamps = false;

    //LA TABELLA NON PRESENTA ALCUNA RELAZIONE CON ALTRE TABELLE
    
}

?>   