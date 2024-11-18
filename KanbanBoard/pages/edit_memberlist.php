<?php
$path = realpath(__DIR__ ."/../"); 
require_once("$path/Database/DatabaseConnection.php");
require_once("$path/Repositories/UserRepository.php");

$userRepo = new UserRepository(DatabaseConnection::getInstance());

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {

    $id = $_POST['id'];

    if (!empty($_FILES['profilePic']['name'])) {
        $img_name = $_FILES['profilePic']['name'];
        $tmp_name = $_FILES['profilePic']['tmp_name'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = "IMG-" . $id . '.' . $img_ex_lc;
            $img_upload_path = '../image/' . $new_img_name;
            $r = move_uploaded_file($tmp_name, $img_upload_path);
        }
    } else {
        $userRepo = new UserRepository(DatabaseConnection::getInstance());
        $user = $userRepo->find($id);
        $new_img_name = $user->img;
    }

    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $role_id = $_POST['role'];
    $result = $userRepo->update($id, $new_img_name, $name, $email, $password, $gender, $role_id);

    if ($result) {
        header('Location: memberlist_admin.php');
        exit;
    } else {
        echo "Sorry, updating profile fails.";
    }
}