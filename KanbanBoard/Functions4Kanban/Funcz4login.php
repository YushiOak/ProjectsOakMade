<?php
$path = realpath(__DIR__."/../");
session_start();
require_once("$path/Database/DatabaseConnection.php");
require_once("$path/Repositories/UserRepository.php");

$userRepo = new UserRepository(DatabaseConnection::getInstance());

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signin'])){

    if (isset($_POST["email"]) && isset($_POST["password"])){
        $email      =  $_POST["email"];
        $password   =  $_POST["password"];
        $result =  $userRepo->LoginValid($email,$password);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id']  = $user['id'];
            $role_id = $user['role_id'];

            if ($role_id == '1') {
                header("Location: ../pages/add_project_admin.php");
                exit;
            } else {
                header("Location: ../pages/add_project_member.php");
                exit;
            }
        } else {
        $LoginError = '<p style="display:flex; justify-content: center;">Login Error !</p><p>invalid email or password please try again </p>';
        session_start();
        $_SESSION['LoginError'] = $LoginError; 
            header("Location: ../pages/login.php");
        }
    }
}
?>