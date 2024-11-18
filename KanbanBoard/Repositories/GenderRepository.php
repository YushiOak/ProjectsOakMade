<?php
    $path = realpath(__DIR__."/../");
    require_once("$path/Models/Gender.php");
    require_once("$path/Database/DatabaseConnection.php");

    class GenderRepository{
        public static $table_name = "genders";
        private $connection;

        public function __construct(){
            $this->connection = DatabaseConnection::getInstance();
        }

        public function getAll(){
            $genders = [];
            $query = "SELECT * FROM ". self::$table_name . ";";

            $results = $this->connection->query($query);
            if($results){
                while($row = mysqli_fetch_object($results)){
                    $genders[] = $this->toModel($row);
                }
            }
            return $genders;
        }

        public function find($id){
            $gender   = null;
            $query  = "SELECT * FROM ".self::$table_name." WHERE id = $id;";
            $result = $this->connection->query($query);
            if($result) $gender = $this->toModel(mysqli_fetch_object($result));
            return $gender;
        }

        public function delete(Model $model){}
        public function create(Model $model){}
        public function update(Model $model){}

        public function toModel($obj){
            $gender = null;
            if($obj)
                $gender = new Role($obj->id, $obj->name);
            return $gender;
        }
    }
?>  