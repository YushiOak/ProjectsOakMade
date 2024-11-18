<?php
require_once("../Database/DatabaseConnection.php");
require_once("../Repositories/TaskRepository.php");
$TaskRepo = new TaskRepository(DatabaseConnection::getInstance());


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['DeleteTask'])){

    if (isset($_POST["task_id"])){
        $task_id      =  $_POST["task_id"];
        $result       =  $TaskRepo->delete($task_id);

        $projectId = $_POST['project_id'];
        header('Location: ../pages/home_admin.php?id='.$projectId); 
    }
}
?>