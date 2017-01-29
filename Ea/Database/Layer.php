<?php


namespace Ea\Database;

require_once 'Database.php';

class Layer extends Database {

    protected $statement;
    
    public function __construct($st, $val, $tb) {

        $this->statement = new \stdClass;
        
        $this->statement->table = strtolower($tb);
        $this->statement->values = (empty($val) ? $st : [$st => $val]);
        
        
    }
}
