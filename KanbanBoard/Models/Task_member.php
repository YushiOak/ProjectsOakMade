<?php
    $path = realpath(__DIR__."/../");
    require_once("Model.php");
    require_once("$path/Repositories/Task_memberRepository.php");

    class TaskMember extends Model{
        public $id;
        public $user_id;
        public $user;
        public $task_id;
        public $task;
        
        public function __construct($id, $user_id, $task_id)
        {
            $this->id           =   $id;
            $this->user_id      =   $user_id;
            $this->user         =   taskMemberRepository::getUserName($this);
            $this->task_id      =   $task_id;
            $this->task         =   taskMemberRepository::getTaskName($this);
        }

        public function getUser(){
            return $this->user;    
        }

        public function getTask(){
            return $this->task;    
        }
    }
?>  