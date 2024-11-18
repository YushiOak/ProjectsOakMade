
<?php

// sayar close to close error 
// session_start();

$path = realpath(__DIR__ ."/../"); 
require_once("$path/Database/DatabaseConnection.php");
require_once("$path/Repositories/UserRepository.php");


$uid = $_GET['uid'];
$edit_userRepo = new UserRepository(DatabaseConnection::getInstance());
$edit_user = $edit_userRepo->find($uid);

$editImagePath = (isset($edit_user->img) && !empty($edit_user->img)) ? "../image/".$edit_user->img."?v=".time() : "../image/default.jpg";

$selectedGender = $edit_user->gender_id;    
$maleSelected = ($selectedGender == 1) ? 'selected' : '';
$femaleSelected = ($selectedGender == 2) ? 'selected' : '';


$selectedRole = $edit_user->role_id;
$adminSelected = ($selectedRole == 1) ? 'selected' : '';
$memberSelected = ($selectedRole == 2) ? 'selected' : '';

// sayar close
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     header("Location: login.php");
//     exit;
//   }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css" />
    
       
</head>
<?php require_once("../header_footer/header.php");?>
<body class="MiYcolumn-container">
    <form class="form-horizontal color" role="form" method="POST" enctype="multipart/form-data" action="edit_memberlist.php">
        <div class="container bootstrap snippets bootdey">
            <h1 class="mt-3 color">Edit Profile</h1>
            <hr>
            <div class="row">
                <!-- left column -->
                <div class="col-md-3">
                    <div class="text-center">
                        <img src="<?= $editImagePath ?>"  class="avatar img-circle img-thumbnail" alt="avatar">
                    </div>
                </div>

                <!-- edit form column -->
                <div class="col-md-9 personal-info">
                    <h3>Personal info</h3>

                    <input class="form-control  color" value="<?= $edit_user->id ?>" type="text" name="id" hidden>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Name:</label>
                        <div class="col-lg-8">
                            <input class="form-control Miinput-field" value="<?= $edit_user->name ?>" type="text" name="name" required>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-8">
                            <input class="form-control Miinput-field" value="<?= $edit_user->email ?>" type="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label class="col-lg-3 control-label">Password:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="<?= $edit_user->password ?>" name="password" required>
                        </div>
                    </div>
                    
                 
                    <div class="form-group mt-3">
                    <label class="col-lg-3 control-label">Gender:</label>
                        <select class="form-select form-control gender-select Miinput-field" aria-label="Default select example" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="1"  ". <?= $maleSelected ?> .">男性</option>
                            <option value="2"  ". <?= $femaleSelected ?> .">女性</option>
                        </select>
                    </div>

                    <br>
                    <div class="form-group">
                    <label class="col-lg-3 control-label">Role:</label>
                        <select class="form-select gender-select form-control"  aria-label="Default select example" name="role" required >
                            <option value="" selected disabled>Change Role</option>
                            <option value="1" ". <?= $adminSelected ?> .">管理者</option>
                            <option value="2" ". <?= $memberSelected ?> .">メンバー</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <a href="javascript:history.back()"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#79305a" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                            <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1" />
                        </svg></a>
                </div>
                <div class="col-md-6 text-end">
                    <!-- <input type="submit" name="save" value="Save" class="button"> -->
               <button  type="submit" name="save" class="button">Save</button>
               <!-- to add button effect(myo) -->
                </div>
            </div>
        </div>
    </form>

    <!-- This is link of adding small images
		which are used in the link section -->
    <script src="../js/javascript.js"></script>
    <script src="https://kit.fontawesome.com/704ff50790.js" crossorigin="anonymous"></script>
</body>

</html>
