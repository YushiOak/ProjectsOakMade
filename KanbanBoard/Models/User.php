<?php
    $path = realpath(__DIR__."/../");
    require_once("Model.php");
    require_once("$path/Repositories/UserRepository.php");

    class User extends Model{
        public $id;
        public $img;
        public $name;
        public $email;
        public $password;
        public $gender_id;
        public $gender;
        public $role_id;
        public $role;
        
        public function __construct($id, $img, $name, $email, $password, $gender_id, $role_id)
        {
            $this->id           = $id;
            $this->img          = $img;
            $this->name         = $name;
            $this->email        = $email;
            $this->password     = $password;
            $this->gender_id    = $gender_id;
            $this->gender       = UserRepository::getUserGender($this);
            $this->role_id      = $role_id;
            $this->role         = UserRepository::getUserRole($this);
        }

        public function getRole(){
            return $this->role;    
        }

        public function getGender(){
            return $this->gender;    
        }

        public function getTotalProjects()
{
    $projectRepo = new UserRepository(DatabaseConnection::getInstance());
    return $projectRepo->getTotalProjectsByUser($this->id);
}
    }
?>