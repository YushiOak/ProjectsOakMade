<?php
    $path = realpath(__DIR__."/../");
    require_once("Model.php");
    require_once("$path/Repositories/Project_memberRepository.php");

    class ProjectMember extends Model{
        public $id;
        public $user_id;
        public $user;
        public $project_id;
        public $project;
        
        public function __construct($id, $user_id, $project_id)
        {
            $this->id           =  $id;
            $this->user_id      =  $user_id;
            $this->user         =  projectMemberRepository::getUserName($this);;
            $this->project_id   =  $project_id;
            $this->project      =  projectMemberRepository::getProjectName($this);;
        }

        public function getUser(){
            return $this->user;    
        }

        public function getProject(){
            return $this->project;    
        }
    }
?>  