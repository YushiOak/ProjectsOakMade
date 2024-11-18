<?php
$path = realpath(__DIR__."/../");
// var_dump($_POST);
require_once("$path/Repositories/TaskRepository.php");
require_once("$path/Database/DatabaseConnection.php");

$task_id       =    $_GET['task_id'] ?? '';
$color         =    $_GET['new_taskHeader'] ?? '';
$borderColor   =    $_GET['new_taskContainer'] ?? '';

$taskRepo = new TaskRepository(DatabaseConnection::getInstance());

$task = $taskRepo->ChgPriorColor($color,$borderColor,$task_id);
if($task!=null){
    echo json_encode(["code"=>1, "message"=>"success"]);
}else{
    echo json_encode(["code"=>-1, "message"=>"failed"]);
}
?>