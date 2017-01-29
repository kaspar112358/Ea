<?php

namespace Ea\Database;

require_once 'Database.php';

class Layer extends Database {

    protected $table;
    protected $values;
    
    protected $returnId = false;
    protected $returnBool = false;
    
    protected $isDone = false;

    public function __construct($st, $val, $tb) {

        $this->table = strtolower($tb);
        $this->values = (empty($val) ? $st : [$st => $val]);
    
        $self = $this;

        $shutdown = function () use (&$self) {
            $self->execute();
        };
        register_shutdown_function($shutdown);

    }
    
    protected function execute(){}
    
    public function getID(){
        $this->returnId = true;
        
        return $this->execute();
    }
    
    public function getBool(){
        $this->returnBool = true;
        
        return $this->execute();
    }

}
