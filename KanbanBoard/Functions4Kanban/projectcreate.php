<?php
    $path = realpath(__DIR__."/../");
    //require section
    require_once("$path/Repositories/ProjectRepository.php");
    require_once("$path/Database/DatabaseConnection.php");
?>
<?php
    
    $projectRepo = new ProjectRepository(DatabaseConnection::getInstance());
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $admin_id       =   DatabaseConnection::getInstance()->real_escape_string($_POST['admin_id']) ?? '';
        $name           =   DatabaseConnection::getInstance()->real_escape_string($_POST["projectName"]) ?? '';
        $stages         =   $_POST["stages"] ?? '';
        $users_id       =   $_POST["members"] ?? '';
        $description    =   DatabaseConnection::getInstance()->real_escape_string($_POST["Description"]) ?? '';
        $detail_descrip =   DatabaseConnection::getInstance()->real_escape_string($_POST["Detail_Description"]) ?? '';
        $create_date    =   DatabaseConnection::getInstance()->real_escape_string($_POST["createDate"]) ?? '';
        $due_date       =   DatabaseConnection::getInstance()->real_escape_string($_POST["dueDate"]) ?? '';
        
        $min_stages = 3;
        $max_stages = 4;
        if (count($stages) < $min_stages || count($stages) > $max_stages) {
            $stageError = 'You need to add atleast three stages and not more than four!';
            session_start();
            $_SESSION['stageError'] = $stageError; 
            header("Location: ../pages/createproject.php");
        } else {

        $result = $projectRepo->create($admin_id, $name, $description, $detail_descrip, $create_date, $due_date,$stages,$users_id);
        if ($result) {
          header("Location: ../pages/add_project_admin.php");
          exit();
        } else {
            $error_message = "Error inserting task.";
        } 
    }
}
    else{
        $error_message = "One or more required fields are missing.";
    }
?>