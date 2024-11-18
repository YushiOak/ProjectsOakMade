<?php
session_start();
$path = realpath(__DIR__."/../");
    require_once("$path/Database/DatabaseConnection.php");
    require_once("$path/Repositories/ProjectRepository.php");
    require_once("$path/Repositories/StageRepository.php");
    require_once("$path/Repositories/TaskRepository.php");

    //update....
    $task_id = $_GET['task_id'] ?? 0 ;//need to vlidate more deeply
    $stage_id = $_GET['stage_id'] ?? 0 ;//need to vlidate more deeply
    $project_id = $_GET['project_id'] ?? 0 ;//need to vlidate more deeply

    $projectRepo = new ProjectRepository(DatabaseConnection::getInstance());
    $taskRepo = new TaskRepository(DatabaseConnection::getInstance());
    $stageRepo = new StageRepository(DatabaseConnection::getInstance());

    $project   = $projectRepo->find($project_id);
    $task      = $taskRepo->find($task_id);
    $stage     = $stageRepo->find($stage_id);
    $LastStage = $stageRepo->findLastStageId($project_id);
    
    //need to check $task and $stage..
    // if($stage->id != $LastStage){
        $task    = $taskRepo->assignStage($task, $stage); 
        $message = "";
        if($task!=null){
            echo json_encode(["code"=> 1, $message=>"success"]);
        }else{
            echo json_encode(["code"=>-1, $message=>"failed"]);
        }
    // }else{
    //     $conn = DatabaseConnection::getInstance();
    //     $table = "tasks";
        
    //     $query = "
    //         SELECT 
    //             project_id,
    //             CASE
    //                 WHEN COUNT(*) = SUM(CASE WHEN stage_id = $LastStage THEN 1 ELSE 0 END)
    //                 THEN 'Yes'
    //                 ELSE 'No'
    //             END AS is_last_stage_equal_to_total
    //         FROM `$table`
    //         WHERE project_id = $project_id
    //         GROUP BY project_id;";
        
    //     // Execute the query
    //     $stmt = $conn->query($query);
        
    //     // Fetch results
    //     $result = $stmt->fetch_assoc();

    //         // Check if the last stage is equal to total tasks
    //         if ($result['is_last_stage_equal_to_total'] == 'Yes') {
    //             $task    = $taskRepo->assignStage($task, $stage); 
    //             $message = "";
    //             if($task!=null){
    //                 echo json_encode(["code"=> 1, $message=>"success"]);
    //             }else{
    //                 echo json_encode(["code"=>-1, $message=>"failed"]);
    //         }
    //             // Redirect with a flag indicating that last stage is equal to total tasks
    //             header("Location: ../pages/home_admin.php");
    //             $_SESSION['laststageequaltotaltasks']="True";
    //         } else {
    //             $task    = $taskRepo->assignStage($task, $stage); 
    //             $message = "";
    //             if($task!=null){
    //                 echo json_encode(["code"=> 1, $message=>"success"]);
    //             }else{
    //                 echo json_encode(["code"=>-1, $message=>"failed"]);
    //         }header("Location: ../pages/home_admin.php");
    //         $_SESSION['laststageequaltotaltasks']="False";
    //     }
    // }
?>
