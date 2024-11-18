<?php 
    $path = realpath(__DIR__."/../");
    require_once("$path/Models/Task.php");
    require_once("$path/Models/Stage.php");
    require_once("$path/Database/DatabaseConnection.php");
    require_once('ProjectRepository.php');
    require_once('StageRepository.php');

    class Task_historyRepository{

        public static $table_name = "tasks_history";
        private $connection;

        public function __construct($connection){
            $this->connection = $connection;        
        }
        public function find($id){
            $task_his   = null;
            $query  = "SELECT * FROM ".self::$table_name." WHERE id = $id;";
            $result = $this->connection->query($query);
            if($result) 
            $task = $this->toModel(mysqli_fetch_object($result));
            return $task;     
        }
        public static function getTaskStage($task){
            $stageRepo = new StageRepository();
            return $stageRepo->find($task->stage_id);
        }
        public function toModel($obj){
            $task_his = null;
            if($obj)
                $task_his = new Task_historyRepository($obj->id, $obj->task_id, $obj->project_id, $obj->details, $obj->user_id, $obj->change_date);
            return $task_his;
        }
        public function StageChgHisFunc(Task $task, $user_id, Stage $old_stage, Stage $new_stage, $project_id, $change_date) {
            $change_date_formatted = date("Y-m-d H:i:s", strtotime($change_date)); // Format the date properly
            $query = "INSERT INTO " . self::$table_name . " (task_id, project_id, details, user_id, changed_date)  
            VALUES ('{$task->id}', '{$project_id}', 
                    'Changed the task named ({$task->task_name}) to {$new_stage->name} from {$old_stage->name}', 
                    '{$user_id}', '{$change_date_formatted}')";
            $result = $this->connection->query($query);
            if($result === false){
                throw new Exception(mysqli_error($this->connection), -1);
            }else{
                $task_his = Task_historyRepository::find($task->id);
            }
            return $task_his;
        }
    }   
?>
    $path = realpath(__DIR__."/../");
    require_once("$path/Models/Task.php");
    require_once("$path/Models/Stage.php");
    require_once("$path/Database/DatabaseConnection.php");
    require_once('ProjectRepository.php');
    require_once('StageRepository.php');

    class Task_historyRepository{

        public static $table_name = "tasks_history";
        private $connection;

        public function __construct($connection){
            $this->connection = $connection;        
        }
        public function find($id){
            $task_his   = null;
            $query  = "SELECT * FROM ".self::$table_name." WHERE id = $id;";
            $result = $this->connection->query($query);
            if($result) 
            $task = $this->toModel(mysqli_fetch_object($result));
            return $task;     
        }
        public static function getTaskStage($task){
            $stageRepo = new StageRepository();
            return $stageRepo->find($task->stage_id);
        }
        public function toModel($obj){
            $task_his = null;
            if($obj)
                $task_his = new Task_historyRepository($obj->id, $obj->task_id, $obj->project_id, $obj->details, $obj->user_id, $obj->change_date);
            return $task_his;
        }
        public function StageChgHisFunc(Task $task, $user_id, Stage $old_stage, Stage $new_stage, $project_id, $change_date) {
            $change_date_formatted = date("Y-m-d H:i:s", strtotime($change_date)); // Format the date properly
            $query = "INSERT INTO " . self::$table_name . " (task_id, project_id, details, user_id, changed_date)  
            VALUES ('{$task->id}', '{$project_id}', 
                    'Changed the task named ({$task->task_name}) to {$new_stage->name} from {$old_stage->name}', 
                    '{$user_id}', '{$change_date_formatted}')";
            $result = $this->connection->query($query);
            if($result === false){
                throw new Exception(mysqli_error($this->connection), -1);
            }else{
                $task_his = Task_historyRepository::find($task->id);
            }
            return $task_his;
        }
    }   
?>