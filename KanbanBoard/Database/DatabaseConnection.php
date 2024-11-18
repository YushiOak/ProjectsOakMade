<?php
    class DatabaseConnection{
        private static $server      = 'localhost';
        private static $user        = 'root';
        private static $password    = '';
        private static $database    = 'kanban';

        private static $connection = null;
        public static function getInstance(){
            if(self::$connection == null){
                $dbConnection = new DatabaseConnection();
                self::$connection = new mysqli(self::$server, self::$user, self::$password, self::$database);
            }
            return self::$connection;
        }
        public function __construct(){
        }

        
    }
?>

