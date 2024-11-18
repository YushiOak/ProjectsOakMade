<?php
    $path = realpath(__DIR__."/../");
    require_once("Model.php");
    require_once("$path/Repositories/StageRepository.php");

    class Stage extends Model{
        public $id;
        public $name;
        public $project_id;
        public $project;
        
        public function __construct($id, $name, $project_id)
        {
            $this->id           =   $id;
            $this->name         =   $name;
            $this->project_id   =   $project_id;
            $this->project      =   StageRepository::getProjectName($this);
        }

        public function getProject(){
            return $this->project;    
        }
    }
?>  