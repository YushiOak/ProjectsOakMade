<?php 
$path = realpath(__DIR__."/../");
require_once("$path/Repositories/UserRepository.php");
require_once("$path/Repositories/ProjectRepository.php");
require_once("$path/Repositories/StageRepository.php");
require_once("$path/Repositories/TaskRepository.php");

$isMember = $isMember??'';
$isAdmin = $isAdmin??'';

$dbConnection = DatabaseConnection::getInstance();
$projectRepository = new ProjectRepository($dbConnection);
$projects = $projectRepository->getAll();

$id = intval($_GET["id"]?? '2');
$projects = $projectRepository->find($id);

?>  
<?php

session_start(); 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
  $userID = $_SESSION['user_id'];
  $userRepo = new UserRepository(DatabaseConnection::getInstance());
  $user = $userRepo->find($userID);
}
$isAdminMemberFromPJwebpage = $isAdminMemberFromPJwebpage??'';
// if ($isAdminMemberFromPJwebpage) {
//   // Display content for members
//   echo "<script>alert('Welcome, Member!');</script>";
// } else {
//   // Display content for guests
//   echo "Welcome, Guest!";
// }


// Find the user with the specified ID
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kanban Board</title>
    <!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">    
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
      <link rel="icon" type="image/png" href="../image/logo2_2.PNG">
  </head>
  <body>
    <header>
      <div class="info-container">
        <h1>
          <?php if($isMember || $isAdmin){?>
              <img src="../image/logo2.png" width="120px" height="50px">
          <?php }else{?> 

          <img src="../image/logo2.png" width="120px" height="50px">
          
          <?php } ?>
          
          <!-- <span class="YspanBoard"></span></h1> -->
        <p class="mt-3">
           Organise tasks  as well as add new ones and
          delete old ones.
        </p>
      </div>

      <div class="menu-icon" onclick="toggleMenu()">
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      </div>

     <div class="menu-container">
     <ul>
           <?php if(!$isAdminMemberFromPJwebpage):?>
         <li>
            <a href="<?= ($isAdmin ? '../pages/add_project_admin.php' : (isset($user) && $user->role_id == 2 ? '../pages/add_project_member.php' : '../pages/add_project_admin.php')) ?>" class="btn mt-3">Projects Board</a>
          </li>
          <?php endif;?>
      <?php 
          if ($isAdmin) :?>
          <li>
             <a href="../pages/createtask.php?id=<?= isset($projects->id) ? $projects->id : ''; ?>" class="btn  mt-3">Add Task</a>
          </li>
             <?php endif ?>
          
          <li>
            <a href="<?= ($isAdmin ? '../pages/memberlist_admin.php' : (isset($user) && $user->role_id == 2 ? '../pages/memberlist_member.php' : '../pages/memberlist_admin.php')) ?>" class="btn mt-3">Member List</a>
          </li>
          
            <li>
            <a href="../Functions4Kanban/signout.php" class="btn  mt-3 ">LogOut</a>
            </li>
               
            <li>
                <a href="viewprofile.php?id=<?= $userID ?>" class="circle-container">
                <?php
               $imagePath = (isset($user->img) && !empty($user->img)) ? "../image/".$user->img."?v=".time() : "../image/default.jpg";
                ?>
                <img src="<?= $imagePath ?>" id="photoPreview" class="avatar img-circle img-thumbnail" alt="avatar">

                </a>
            </li>
            </ul>
            </div>
          
          <!-- <div class="d-flex Profilecircle mr-3">
                <a href="#" class="circle-container">

                <?php 
                    // if ($isAdminMemberFromPJwebpage || $isCreateTask ||$isCreateProject) { 
                      ?>
                     <img src="../image/p2.jpg">
                    <?php 
                  // }else {
                    ?> 

                    <img src="image/p2.jpg">

                    <?php 
                  // } 
                  ?>
                </a> -->
                
                
          </div>
          <!-- <i class="fa-solid fa-bars"></i> -->
      </div>
    </header>

     <!--bootstrap css1 js 1-->
    
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     <script src="../js/menu.js"></script>
  </body>
</html>