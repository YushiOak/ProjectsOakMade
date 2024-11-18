<?php
$path = realpath(__DIR__."/../");
    require_once("$path/Database/DatabaseConnection.php");
    require_once("$path/Repositories/UserRepository.php");
    require_once("$path/Repositories/ProjectRepository.php");
    require_once("$path/Repositories/StageRepository.php");
    require_once("$path/Repositories/TaskRepository.php");
    require_once("$path/Repositories/Task_historyRepository.php");

    //update....
    $task_id = $_GET['task_id'] ?? 0 ;//need to vlidate more deeply
    $user_id = $_GET['user_id'] ?? 0 ;//need to vlidate more deeply
    $old_stage_id = $_GET['old_stage_id'] ?? 0 ;//need to vlidate more deeply
    $new_stage_id = $_GET['new_stage_id'] ?? 0 ;//need to vlidate more deeply
    $project_id = $_GET['project_id'] ?? 0 ;//need to vlidate more deeply

    $task_his_repo = new Task_historyRepository(DatabaseConnection::getInstance());
    $userRepo = new UserRepository(DatabaseConnection::getInstance());
    $projectRepo = new ProjectRepository(DatabaseConnection::getInstance());
    $taskRepo = new TaskRepository(DatabaseConnection::getInstance());
    $stageRepo = new StageRepository(DatabaseConnection::getInstance());
    date_default_timezone_set('Asia/Yangon');
    $change_date = date("Y-m-d H:i:s");
    $project     = $project_id;
    $task        = $taskRepo->find($task_id);
    $old_stage   = $stageRepo->find($old_stage_id);
    $new_stage   = $stageRepo->find($new_stage_id);
    $user        = $user_id;
        
    $task_his    = $task_his_repo->StageChgHisFunc($task,$user,$old_stage,$new_stage,$project,$change_date); 
    $message = "";
    if($task!=null){
    echo json_encode(["code"=> 1, $message=>"success"]);
    }else{
    echo json_encode(["code"=> -1, $message=>"failed"]);
}
?>