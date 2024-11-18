<?php
require_once('../header_footer/header.php');
include('DB_connection.php');
// require_once('header&footer/footer.php');

require_once('chart_data_function.php');

require_once("../Database/DatabaseConnection.php");
require_once("../Repositories/UserRepository.php");
$id = $_SESSION['user_id'];
$userRepo = new UserRepository(DatabaseConnection::getInstance());
$user = $userRepo->find($id);
$role_id= $user->role_id;
$selectedGender = $user->gender_id;
$maleSelected = ($selectedGender == 1) ? 'selected' : '';
$femaleSelected = ($selectedGender == 2) ? 'selected' : '';
$result = false;
  // Check if the form has been submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])){
    if(!empty($_FILES['profilePicture']['name'])){
     $img_name = $_FILES['profilePicture']['name'];
     $tmp_name = $_FILES['profilePicture']['tmp_name'];
      
     $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
       $img_ex_lc = strtolower($img_ex);
 
       $allowed_exs = array("jpg", "jpeg", "png"); 
 
       if (in_array($img_ex_lc, $allowed_exs)) {
         $new_img_name = "IMG-". $id . '.'.$img_ex_lc;
         $img_upload_path = '../image/'.$new_img_name;
         $r = move_uploaded_file($tmp_name, $img_upload_path);
      }
     }else
     {
       $userRepo = new UserRepository(DatabaseConnection::getInstance());
       $user = $userRepo->find($id);
       $new_img_name = $user->img;
     }
     // Retrieve the form data
     $name = $_POST['name'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $gender = $_POST['gender'];
     $result = $userRepo->update($id, $new_img_name, $name, $email, $password, $gender, $role_id);
 
      // exit();
     if($result){
     header('Location: viewprofile.php');
     exit;
     }else {
       echo "Sorry, updating profile fails.";
      }
 }
?>
 <?php
  $imagePath = (isset($user->img) && !empty($user->img)) ? "../image/".$user->img."?v=".time() : "../image/default.jpg";
  $projectMemberRepo = new ProjectMemberRepository(DatabaseConnection::getInstance());
  $projects = $projectMemberRepo->findWithMemberID($id);
?>
<!Doctype html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- custom css  -->
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    
    <!-- title logo  -->
    <link rel="icon" type="image/png" href="../image/logo2_2.PNG">

    <!-- Include the JavaScript file -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
 <!-- custom chart.js  -->
  <script src="../js/charts.js"></script> 
  <script src="../js/javascript.js<?= "?v=".time()?>"></script>

 </head>  
 <body>
 <section class="Ycolumn-container MiYrow row  ">
 <div class="col-lg-3 MiYprofile-edit-leftsidebar">
  <form action="profileedit.php" method="POST" enctype="multipart/form-data">
     <!-- photo edit -->
     <div class="wrapper mt-4">
     <img src="<?= $imagePath ?>" id="photoUpload">  
 <input type="file" id="file" class="myfile" accept=".jpg, .jpeg, .png" name="profilePicture" onchange="previewPhoto(event)">
</div>
<!-- <br> -->

   <div class="container-edit">   
   <div>
   &nbsp; &nbsp;&nbsp; <label for="name" class="labeledit mt-2">Name :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" value="<?= $user->name ?>" required class="Miinput-fieldedit  p-3 mb-2 rounded" name="name"><br>
    </div>
    <!-- <br> -->

    <div>
    &nbsp;&nbsp; &nbsp; <label for="email" class="labeledit mt-2">Email :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="email" value="<?= $user->email ?>" required class="Miinput-fieldedit  p-3 mb-2 rounded" name="email" ><br>
    </div>
    <!-- <br> -->

    <div class="psw-eye">
    &nbsp;&nbsp;&nbsp;&nbsp; <label for="password" class="labeledit mt-2">Password :</label>&nbsp;
    <input type="password" value="<?= $user->password ?>" required name="password" id="password" class="Miinput-fieldedit  p-3 mb-2 rounded" ><br>
    <!-- <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i> -->
     
    <!-- add toggle eye (myo)   -->
    <i class="fas Yeyeedit fa-eye-slash  toggle-password " ></i>
                       
    </div>
    <!-- <br> -->
    
    <div>
    &nbsp;&nbsp;&nbsp;&nbsp; <label for="gender" class="labeledit mt-2">Gender :</label>&nbsp;&nbsp;&nbsp;&nbsp;
    <select class="  Miinput-fieldedit bg-white  p-2 mb-2 rounded" name="gender" required>
    <option value="1"  ". <?= $maleSelected ?> .">男性</option>
    <option value="2"  ". <?= $femaleSelected ?> .">女性</option>
    </select>
    </div><br>
    </div>
    
    <div class="container-button-edit">
    <a class="buttonlink" href="viewProfile.php">
      <button type="button" class="buttonMiedit"  >Back</button></a>
   <!-- <input type="submit" class="buttonMiedit" name="save" value="Save"> -->
   <!-- change button(myo)  -->
   <button  type="submit" name="save" class=" buttonMiedit">Save</button>
   </div>

  </form>
    </div>
  

    <div class="col-lg-9 row">
        <?php if(isset($projects) && !empty($projects)) : ?>
          <?php foreach ($projects as $projectMember) : 
                $project = $projectMemberRepo->getProjectName($projectMember);
                $stages  = $projectRepository->getPieBarChartLineData($projectMember->project_id, $id);
          ?>
              <div class="col-lg-4 Yprojectfromprofile d-flex justify-content-center align-items-center">
              <!-- <div class="coloredit ">
                   
                </div> -->
                <div class="Yproject_card ">
                      <div class="Yproject_img_name d-flex">
                          
                          <span class=" Yproject"> <?= $project->name?></span>
                      </div>

                      <div class="YlineChart_profileview_page">
                        <canvas id="Yproject<?= $project->id ?>" class="Yprojectforspecuser"  width="435" height="217"></canvas>
                      </div>

                    </div>
              </div>  
              <script>
                document.addEventListener("DOMContentLoaded", function() {
                        // JavaScript code for generating pie chart


                        
                        var labels<?= $project->id ?> = [];
                        var data<?= $project->id ?> = [];
                        <?php foreach($stages as $stage): ?>
                            labels<?= $project->id ?>.push("<?=$stage["stage"]?>");
                            data<?= $project->id ?>.push("<?=$stage["count"]?>");
                          
                        <?php endforeach; ?>

                        generateLineChart_for_member('Yproject<?= $project->id ?>', labels<?= $project->id ?>, data<?= $project->id ?>);


                    });
                </script>
          <?php endforeach; ?>    
        <?php else : ?>
            <p>No projects found</p>
        <?php endif; ?>
            </div>
   </section>

              <?php
              require_once('../header_footer/footer.php');
                 ?>



<!-- for psw toggle eye js file(myo )   -->
<script src="../js/psweyecloseopen.js"></script>
 </body>
 </html>