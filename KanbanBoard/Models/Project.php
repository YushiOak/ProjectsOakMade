<?php
    $path = realpath(__DIR__."/../");
    require_once("Model.php");
    require_once("$path/Repositories/ProjectRepository.php");
    require_once("$path/Database/DatabaseConnection.php");

    class Project extends Model{
        public $id;
        public $admin_id;
        public $admin;
        public $name;
        public $description;
        public $detail_descrip;
        public $create_date;
        public $due_date;
        public $completed_date;
        
        public function __construct($id, $admin_id, $name, $description, $detail_descrip, $create_date, $due_date)
        {
            $this->id               = $id;
            $this->admin_id         = $admin_id;
            $this->admin            = ProjectRepository::getAdminName($this);
            $this->name             = $name;
            $this->description      = $description;
            $this->detail_descrip   = $detail_descrip;
            $this->create_date      = $create_date;
            $this->due_date         = $due_date;
        }

        public function getName(){

            return $this->admin;    
        }
    }
?>