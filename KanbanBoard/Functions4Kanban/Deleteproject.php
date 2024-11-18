
<?php
require_once("../Database/DatabaseConnection.php");
require_once("../Repositories/ProjectRepository.php");
$projectRepo = new ProjectRepository(DatabaseConnection::getInstance());


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['project_id'])) {

    if (isset($_POST["project_id"])){
        $project_id = $_POST['project_id'];
        $result = $projectRepo->delete($project_id);

        header('Location: ../pages/add_project_admin.php'); 
    }
}
?>