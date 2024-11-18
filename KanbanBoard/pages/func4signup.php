<?php
$path = realpath(__DIR__ ."/../"); 
session_start();
require_once("$path/Database/DatabaseConnection.php");
require_once("$path/Repositories/UserRepository.php");

$userRepo = new UserRepository(DatabaseConnection::getInstance());

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $_SESSION['signup_data'] = $_POST;

     $name =  DatabaseConnection::getInstance()->real_escape_string($_POST['name'] ?? '');
     $email = DatabaseConnection::getInstance()->real_escape_string($_POST['email'] ?? '');
     $password =  DatabaseConnection::getInstance()->real_escape_string($_POST['password'] ?? '');
     $gender_id = DatabaseConnection::getInstance()->real_escape_string($_POST['gender_id'] ?? '');

    $nameErr = $emailErr = $passwordErr = $genderErr = '';

    // Check if any field is empty
    if (empty($name) || empty($email) || empty($password) || empty($gender_id)) {
        // Redirect back to the signup form with error flags in URL
        header("Location: signup.php?FieldsEmpty=true"
            . (!empty($name) ? '' : '&NameEmpty=true')
            . (!empty($email) ? '' : '&EmailEmpty=true')
            . (!empty($password) ? '' : '&PasswordEmpty=true')
            . (!empty($gender_id) ? '' : '&GenderEmpty=true')
        );
        exit;
    }

    // Proceed with database operations
    $conn = DatabaseConnection::getInstance();
    $table = "users";

    // Check if email already exists
    $check_query = "SELECT * FROM `$table` WHERE email = '$email'";
    $check_result = $conn->query($check_query);

    if ($check_result && $check_result->num_rows > 0) {
        // Redirect back to the signup form with email existence flag in URL
        header("Location: signup.php?EmailExists=true&name=$name&email=$email");
        exit;
    }

    // Insert user data into the database
    $role_id = 2; // Assuming default role_id
    $insert_query = "INSERT INTO `$table` (img ,name, email, password, role_id, gender_id) 
                     VALUES ('default.jpg','$name', '$email', '$password', '$role_id', '$gender_id')";
    $insert_result = $conn->query($insert_query);

    if ($insert_result) {
        // Set session variables and redirect to next page
        $user_id = $conn->insert_id;
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user_id;
        header("Location: add_project_member.php");
        exit;
    } else {
        // If insertion fails, display error message
        echo "Failed to insert user data.";
    }
}
?>
