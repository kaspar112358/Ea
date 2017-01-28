<?php

namespace Ea;

use PDO;

class Engine {
    
    public static function connection(){
        return new PDO('mysql:host=localhost;dbname=ea','root','');
    }
    
    public static function insert($keyorarr, $set = ""){
        
        require_once 'bin/Insert.php';
        
        $values = (empty($set) ? $keyorarr : [$keyorarr => $set]);

        return new \Ea\Actions\Insert($values, get_called_class());
    }
}
