<?php

      // to add projects board nav link(myo) 
    $isAdminMemberFromPJwebpage = true;
    $path = realpath(__DIR__ ."/../"); 
    require_once("$path/Database/DatabaseConnection.php");
    require_once("$path/Repositories/UserRepository.php");
    require_once("$path/Repositories/RoleRepository.php");
    require_once("$path/Repositories/GenderRepository.php");
    require_once("$path/header_footer/header.php");
    require_once("$path/Repositories/ProjectRepository.php");
    require_once("$path/Repositories/Project_memberRepository.php");

 

    // Get the user ID from the URL parameter
    $id = $_SESSION['user_id'];
    $userRepo = new UserRepository(DatabaseConnection::getInstance());
    $user = $userRepo->find($id);
    $role_id = $user->role_id;

    $dbConnection = DatabaseConnection::getInstance();
    $projectRepository = new ProjectRepository($dbConnection);
    $projectMemberRepo = new ProjectMemberRepository($dbConnection);
    $projects = $projectMemberRepo->findWithMemberID($id);
    $totalProjects = count($projects);
    
?>
<!DOCTYPE HTML>
<html>
<head>
  <!-- Include the JavaScript file -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- custom chart.js  -->
    <script src="../js/charts.js"></script> 
    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css  -->
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <!-- title logo  -->
    <link rel="icon" type="image/png" href="../image/logo2_2.PNG">
</head>
<body class="">
    <section class="Ycolumn-container row">
        <div class="leftSideBar col-lg-3 ms-2">
        
            
        <h3 class="text-center Ypjh3 pb-3 mt-3 mb-3">Projects</h3>
              <table class="Yproject_table  mt-5 " cellpadding='10px' cellspacing='20px'>
                  <tr >
                    <td>User's Name </td>
                    <td><?php echo $user->name; ?></td>
                  </tr>
                  <tr>
                    <td>User's Role </td>
                    <td><?php echo $user->role_id == 1 ? '管理者' : 'メンバー'; ?></td>
                  </tr>
                  <tr>
                     <td> Total Projects</td>
                    <td><?=$totalProjects?></td>
                  </tr>


                  <?php foreach($projects as $projectMember): 
                    $project = $projectMemberRepo->getProjectName($projectMember);
                    $due_date = $projectRepository->find($projectMember->project_id);
                  ?>
                    <tr>
                        <td><?= $project->name?></td>
                        <td><?= $projectRepository->calculateDaysLeft($due_date->due_date)?></td>
                    </tr>
                  <?php endforeach; ?>

              </table>
             
            <!-- </div> -->
            <!-- <div class="YlineChart">
              <canvas id="YmylineChart" ></canvas>
            </div> -->
            
        </div>
        <div class="col-lg-9 row">
           
            <!-- <h3 class="text-center Ypjh3 mt-3 mb-3">Projects</h3> -->
            <?php if(isset($projects) && !empty($projects)) : ?>
          
          <?php foreach ($projects as $projectMember) : ?>
          <?php
            $project = $projectMemberRepo->getProjectName($projectMember);
            // Get stage data for the current project
            $stages = $projectRepository->getPieBarChartData($projectMember->project_id);
          ?>

                <div class="col-lg-4 ">
                  
                <a href="home_admin.php?id=<?= $projectMember->project_id ?>">
                  <div class="Ytask-column R-pilechart">
                  <!-- <h3><?= $project->name?></h3> -->
                  <canvas id="YmyChart<?= $projectMember->project_id ?>" class="YChart<?= $projectMember->project_id ?> ychartyoon"></canvas>

                  <!-- Delete project function -->
                  <form action="../Functions4Kanban/Deleteproject.php" method="POST" class="delete-form mt-3">
                  <input type="hidden" name="project_id" value="<?= $projectMember->project_id ?>">
                  <button type="submit" class="button">Delete</button>
                    </form>

                  </div>
                </a>
                </div>  
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                        // JavaScript code for generating pie chart
                        var labels<?= $project->id ?> = [];
                        var data<?= $project->id ?> = [];
                        <?php foreach ($stages as $stage): ?>
                        labels<?= $project->id ?>.push("<?= $stage["stage"] ?>");
                        data<?= $project->id ?>.push(<?= $stage["count"] ?>);
                        <?php endforeach; ?>

                        generatePieChart("YmyChart<?= $project->id ?>", labels<?= $project->id ?>, data<?= $project->id ?> ,"<?= $project->name?>");

                    });
                </script>
            <?php endforeach; ?>
    <?php else : ?>
      <p>No projects found</p>
    <?php endif; ?>  


    <div class="col-lg-4">
                <div class="Ytask-column R-pilechart">
                    <div class="YChart">
                      <!-- <span class="">+</span> -->
                      <div class="YChart Yplus_sign_project"><span><a href="createproject.php"> <i class="fa-regular fa-square-plus"></i></a></span></div>
                    </div>
                    <div></div>
                </div>
              </div>
    </section>

<?php 
$isAdminMemberFromPJwebpage = true;
require_once("$path/header_footer/footer.php");

// require_once('chart_data_function.php');
?>


<script>
  var labels5 = [];
    var data5 = [];
    <?php foreach($totalProject as $tp): ?>
        labels5.push("<?=$tp["project"]?>");
       
    <?php endforeach; ?>

    <?php foreach($donePercentage as $dp): ?>
       
        data5.push(<?=$dp?>);
    <?php endforeach; ?>

    

    generateLineChart('YmylineChart', labels5, data5,'Done percentage for each project');

</script>

</body>
</html>
