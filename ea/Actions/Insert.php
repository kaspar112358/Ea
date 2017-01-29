<?php

namespace Ea\Actions;

require_once '../Database/Layer.php';

class Insert extends \Ea\Database\Layer {

    public function isNonExistent($boolOrArrayOrKey = true, $valueOfKey = ""){

        $this->statement->isNonExistent = (empty($valueOfKey) ? $boolOrArrayOrKey : [$boolOrArrayOrKey => $valueOfKey]);
        
        return $this;
    }
    
    public function returnId(){
        $this->statement->returnId = true;
        
        return $this;
    }
    
    public function execute(){
        
        $statement = $this->handleRequest();
        
        if(array_key_exists("isNonExistent", $this->statement) && $this->statement->isNonExistent && !$this->doesItExist()) return false;

        return $this->executeStatement($statement, $this->statement->values, (array_key_exists("returnId", $this->statement) && $this->statement->returnId ? "id" : "bool"));
    }
    
    /* Private functions */
    
    private function handleRequest(){
        $statement = "INSERT INTO ".$this->statement->table;
        
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
        
        $statement = "SELECT * FROM ".$this->statement->table." WHERE ";
        
        $param = $this->statement->isNonExistent;
        
        $values = (is_array($param) ? $param : $this->statement->values);
        
        $i = 0;
        $no = count($values);

        foreach($values as $key => $value){

            $statement .= $key." = '".$value."'";

            if(++$i != $no){
                $statement .= " AND ";
            }
        }
        
        return empty($this->executeStatement($statement, [], "results"));
    }
}