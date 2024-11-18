<?php
    $path = realpath(__DIR__."/../");
    require_once("Model.php");
    require_once("$path/Repositories/Task_historyRepository.php");

    class Task extends Model{
        public $id;
        public $task_id;
        public $project_id;
        public $details;
        public $user_id;
        public $change_date;

        public function __construct($id,$task_id,$project_id,$details,$user_id,$change_date)
        {
            $this->id          = $id;
            $this->task_id     = $task_id;
            $this->project_id  = $project_id;
            $this->details     = $details;
            $this->user_id     = $user_id;
            $this->change_date = $change_date;
        } 
    }
?>