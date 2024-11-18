<?php
    $path = realpath(__DIR__."/../");
    require_once("$path/Models/Project_member.php");
    require_once("$path/Database/DatabaseConnection.php");
    require_once('UserRepository.php');
    require_once('ProjectRepository.php');

    class projectMemberRepository{
        public static $table_name = "project_members";
        private $connection;

        public function __construct(){
            $this->connection = DatabaseConnection::getInstance();
        }

        public function getAll(){
            $projectMembers = [];
            $query = "SELECT * FROM ". self::$table_name . ";";

            $results = $this->connection->query($query);
            if($results){
                while($row = mysqli_fetch_object($results)){
                    $projectMembers[] = $this->toModel($row);
                }
            }
            return $projectMembers;
        }

        public function find($id){
            $projectMember   = null;
            $query  = "SELECT * FROM ".self::$table_name." WHERE id = $id;";
            $result = $this->connection->query($query);
            if($result) $projectMember = $this->toModel(mysqli_fetch_object($result));
            return $projectMember;
        }

        public function findWithMemberID($id){
            $projectMembers   = [];
            $query  = "SELECT * FROM ".self::$table_name." WHERE user_id = $id;";

            $results = $this->connection->query($query);
            if($results) {
                while($row = mysqli_fetch_object($results)){
                    $projectMembers[] = $this->toModel($row);
                }
            }
            return $projectMembers;
        }

        public function findWithProjectID($id){
            $projectMembers   = [];
            $query  = "SELECT * FROM ".self::$table_name." WHERE project_id = $id;";

            $results = $this->connection->query($query);
            if($results) {
                while($row = mysqli_fetch_object($results)){
                    $projectMembers[] = $this->toModel($row);
                }
            }
            return $projectMembers;
        }

        public function delete($id){
            $query  = "DELETE FROM ".self::$table_name." WHERE id = $id limit 1;";
            $result = $this->connection->query($query);
            return true;
        }

        public function create($user_id, $project_id){
            foreach ($user_id as $u) {
                $query = "
                    INSERT INTO ".self::$table_name." (id, user_id, project_id) 
                    VALUES (null, $u, $project_id);
                ";
                $results = $this->connection->query($query);
            }
            return true;
        }

        public function update(Model $model){}

        public function toModel($obj){
            $projectMember = null;
            if($obj)
                $projectMember = new ProjectMember($obj->id, $obj->user_id, $obj->project_id);
            return $projectMember;
        }

        public static function getUserName($projectMember){
            $userRepo = new UserRepository(DatabaseConnection::getInstance());
            return $userRepo->find($projectMember->user_id);
        }

        public static function getProjectName($projectMember){
            $projectRepo = new ProjectRepository(DatabaseConnection::getInstance());
            return $projectRepo->find($projectMember->project_id);
        }
    }
?> 