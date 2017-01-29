<?php

namespace Ea\Actions;

class Update  {
    
    private $statement;
    
    public function __construct($st, $tb) {
        $this->statement = new \stdClass;
        
        $this->statement->table = strtolower($tb);
        $this->statement->values = $st;
        
    }
}
