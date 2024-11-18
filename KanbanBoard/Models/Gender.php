<?php
    require_once("Model.php");

    class Gender extends Model{
        public $id;
        public $name;
        
        public function __construct($id, $name)
        {
            $this->id       =$id;
            $this->name     =$name;
        }
    }
?>  