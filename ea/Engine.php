<?php

namespace Ea;

use PDO;

class Engine {
    
    private static function table($class){
        $checkfortable = new $class();

        if(isset($checkfortable->table)) return $checkfortable->table;
        
        return $class;
    }
    
    public static function insert($keyOrArray, $valueOfKey = ""){
        
        require_once 'Actions/Insert.php';

        return new \Ea\Actions\Insert($keyOrArray, $valueOfKey, Engine::table(get_called_class()));
        
    }
    
    public static function update($keyOrArray, $valueOfKey = ""){
        
        require_once 'Actions/Update.php';
        
        return new \Ea\Actions\Update($keyOrArray, $valueOfKey, Engine::table(get_called_class()));
        
    }
}
