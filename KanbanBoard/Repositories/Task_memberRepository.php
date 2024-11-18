<?php
    $path = realpath(__DIR__."/../");
    require_once("$path/Models/Task_member.php");
    require_once("$path/Database/DatabaseConnection.php");
    require_once('UserRepository.php');
    require_once('TaskRepository.php');

    class taskMemberRepository{
        public static $table_name = "task_members";
        private $connection;

        public function __construct(){
            $this->connection = DatabaseConnection::getInstance();
        }

        public function getAll(){
            $taskMembers = [];
            $query = "SELECT * FROM ". self::$table_name . ";";

            $results = $this->connection->query($query);
            if($results){
                while($row = mysqli_fetch_object($results)){
                    $taskMembers[] = $this->toModel($row);
                }
            }
            return $taskMembers;
        }

        public function find($id){
            $taskMember   = null;
            $query  = "SELECT * FROM ".self::$table_name." WHERE id = $id;";
            $result = $this->connection->query($query);
            if($result) $taskMember = $this->toModel(mysqli_fetch_object($result));
            return $taskMember;
        }

        public function findWithMemberID($id){
            $taskMembers   = [];
            $query  = "SELECT * FROM ".self::$table_name." WHERE user_id = $id;";

            $results = $this->connection->query($query);
            if($results) {
                while($row = mysqli_fetch_object($results)){
                    $taskMembers[] = $this->toModel($row);
                }
            }
            return $taskMembers;
        }

        public function findWithTaskID($id){
            $taskMembers   = [];
            $query  = "SELECT * FROM ".self::$table_name." WHERE task_id = $id;";

            $results = $this->connection->query($query);
            if($results) {
                while($row = mysqli_fetch_object($results)){
                    $taskMembers[] = $this->toModel($row);
                }
            }
            return $taskMembers;
        }

        public function delete($id){
            $query  = "DELETE FROM ".self::$table_name." WHERE id = $id limit 1;";
            $result = $this->connection->query($query);
            return true;
        }

        public function create($user_id, $task_id){
            foreach ($user_id as $u) {
                $query = "
                    INSERT INTO ".self::$table_name." (id, user_id, task_id) 
                    VALUES (null, $u, $task_id);
                ";
                $results = $this->connection->query($query);
            }
            return true;
        }

        public function update(Model $model){}

        public function toModel($obj){
            $taskMember = null;
            if($obj)
                $taskMember = new TaskMember($obj->id, $obj->user_id, $obj->task_id);
            return $taskMember;
        }

        public static function getUserName($taskMember){
            $userRepo = new UserRepository(DatabaseConnection::getInstance());
            return $userRepo->find($taskMember->user_id);
        }

        public static function getTaskName($taskMember){
            $taskRepo = new TaskRepository(DatabaseConnection::getInstance());
            return $taskRepo->find($taskMember->task_id);
        }
    }
?> 