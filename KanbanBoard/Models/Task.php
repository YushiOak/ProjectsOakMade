<?php
    $path = realpath(__DIR__."/../");
    require_once("Model.php");
    require_once("$path/Repositories/TaskRepository.php");

    class Task extends Model{
        public $id;
        public $project_id;
        public $project;
        public $stage_id;
        public $stage;
        public $short_description;
        public $task_name;
        public $task_priority_color;
        public $task_priority_border;
        
        public function __construct($id, $project_id, $stage_id, $short_description, $task_name,$task_priority_color,$task_priority_border)
        {
            $this->id                   = $id;
            $this->project_id           = $project_id;
            $this->project              = TaskRepository::getProjectName($this);
            $this->stage_id             = $stage_id;
            $this->stage                = TaskRepository::getTaskStage($this);
            $this->short_description    = $short_description;
            $this->task_name            = $task_name;
            $this->task_priority_color  = $task_priority_color;
            $this->task_priority_border = $task_priority_border;
        }

        public function getStage(){
            return $this->stage;    
        }

        public function getPjName(){
            return $this->project;    
        }
    }
?>