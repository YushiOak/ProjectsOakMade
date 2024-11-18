<?php
$path = realpath(__DIR__."/../");
require_once("$path/Database/DatabaseConnection.php");
require_once("$path/Repositories/ProjectRepository.php");

$dbConnection = DatabaseConnection::getInstance();
$projectRepository = new ProjectRepository($dbConnection);
$projects = $projectRepository->getAll();
$project_id = $projects[0]; // Assuming you want to use the first project_id from the array

$conn = DatabaseConnection::getInstance();
$query = "SELECT s.name AS stage, COUNT(t.id) AS count 
            FROM stages s
            LEFT JOIN tasks t ON t.stage_id = s.id
            WHERE t.project_id = '$project_id' AND s.project_id = '$project_id'
            GROUP BY s.id";

$result = $conn->query($query);
$stages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $stages[] = $row;
}
?>
