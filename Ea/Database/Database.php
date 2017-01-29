<?php

namespace Ea\Database;

use PDO;

class Database {

    private function connection(){
        return new PDO('mysql:host=localhost;dbname=ea','root','');
    }
    
    public function executeStatement($statement, $data = [], $withmode = "bool"){
        
        $connection = $this->connection();
        
        try {
            $sth = $connection->prepare($statement);
            $sth->execute($data);

            switch ($withmode) {
                case "bool":
                    return true;
                    break;
                case "id":
                    return $connection->lastInsertId();
                    break;
                case "results":
                    return $sth->fetchAll(PDO::FETCH_OBJ);
                    break;
                default:
                    break;
            }
            
        } catch (Exception $ex) {
            
            return 'Connection failed: '.$ex->getMessage();
        }
        
        return false;
    }
}
