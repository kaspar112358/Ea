<?php

namespace Ea\Actions;

use PDO;

class Insert {
    
    private $statement;
    
    public function __construct($st, $tb) {
        $this->statement = new \stdClass;
        
        $this->statement->table = $tb;
        $this->statement->values = $st;
        
        $this->statement->dontExist = false;
        $this->statement->returnId = false;
    }
    
    public function dontExist(){
        $this->statement->dontExist = true;
        
        return $this;
    }
    
    public function returnId(){
        $this->statement->returnId = true;
        
        return $this;
    }
    
    public function execute(){
        
        $statement = $this->handleRequest();
        
        if($this->statement->dontExist && !$this->doesItExist()) return false;

        try {
            $sth = \Ea\Engine::connection()->prepare($statement);
            $sth->execute($this->statement->values);

            return ($this->statement->returnId ? \Ea\Engine::connection()->lastInsertId() : true);
            
        } catch (Exception $ex) {
            
            return 'Connection failed: '.$ex->getMessage();
        }
        
        return false;
    }
    
    /* Private functions */
    
    private function handleRequest(){
        $statement = "INSERT INTO ".strtolower($this->statement->table);
        
        foreach($this->statement as $key => $state){
            switch ($key) {
                case "values":
                    $statement .= $this->handleValues();

                    break;
                default:
                    break;
            }
        }
        
        return $statement;
    }
    
    private function handleValues(){
        $values = $this->statement->values;
        
        $keys = "";
        $vals = "";
        
        $i = 0;
        $no = count($values);
        
        foreach($values as $key => $value){
            $keys .= $key;
            $vals .= ":".$key;
                    
            if(++$i != $no){
                $keys .= ",";
                $vals .= ",";
            }
        }
        
        return "(".$keys.") VALUES (".$vals.")";
    }
    
    private function doesItExist(){
        try {
            $sth = \Ea\Engine::connection()->prepare("SELECT * FROM food WHERE name = 'hans'");
            $sth->execute();
                
            return empty($sth->fetch());
                
        } catch (Exception $ex) {
            print 'Connection failed: '.$ex->getMessage();
        }
        
        return false;
    }
}