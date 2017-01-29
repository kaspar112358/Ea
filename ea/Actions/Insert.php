<?php

namespace Ea\Actions;

require_once \Ea\Engine::path().'/Database/Layer.php';

use Ea\Database\Layer as Layer;

class Insert extends Layer {
    
    private $isNonExistent = false;

    public function isNonExistent($boolOrArrayOrKey = true, $valueOfKey = ""){

        $this->isNonExistent = (empty($valueOfKey) ? $boolOrArrayOrKey : [$boolOrArrayOrKey => $valueOfKey]);
        
        return $this;
    }

    protected function execute(){
        
        if(!$this->isDone){

            $statement = $this->handleRequest();

            if($this->isNonExistent && !$this->doesItExist()) return false;
            
            $this->isDone = true;

            return $this->executeStatement($statement, $this->values, ($this->returnId ? "id" : "bool"));
        }
        
        return false;
    }
    
    /* Private functions */
    
    private function handleRequest(){
        $statement = "INSERT INTO ".$this->table;
        
        $statement .= $this->handleValues();
        
        return $statement;
    }
    
    private function handleValues(){
        $values = $this->values;
        
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
        
        $statement = "SELECT * FROM ".$this->table." WHERE ";
        
        $param = $this->isNonExistent;
        
        $values = (is_array($param) ? $param : $this->values);
        
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