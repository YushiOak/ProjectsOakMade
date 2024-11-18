<?php
    $path = realpath(__DIR__."/../");
    require_once("$path/Models/Role.php");
    require_once("$path/Database/DatabaseConnection.php");

    class RoleRepository{
        public static $table_name = "roles";
        private $connection;

        public function __construct(){
            $this->connection = DatabaseConnection::getInstance();
        }
        
        public function getAll(){
            $roles = [];
            $query = "SELECT * FROM ". self::$table_name . ";";

            $results = $this->connection->query($query);
            if($results){
                while($row = mysqli_fetch_object($results)){
                    $roles[] = $this->toModel($row);
                }
            }
            return $roles;
        }

        public function find($id){
            $role   = null;
            $query  = "SELECT * FROM ".self::$table_name." WHERE id = $id;";
            $result = $this->connection->query($query);
            if($result) $role = $this->toModel(mysqli_fetch_object($result));
            return $role;
        }

        public function delete(Model $model){}
        public function create(Model $model){}
        public function update(Model $model){}

        public function toModel($obj){
            $role = null;
            if($obj)
                $role = new Role($obj->id, $obj->name);
            return $role;
        }
    }
?>  