<?php 
$path = realpath(__DIR__."/../"); 
require_once("$path/Repositories/ProjectRepository.php");
require_once("$path/Repositories/TaskRepository.php");
require_once("$path/Repositories/UserRepository.php");
require_once("$path/Repositories/Project_memberRepository.php");
?>
<?php 
// require_once('pages/loader.php');
$isMember = true;
require_once("$path/header_footer/header.php");
$userid = $_SESSION['user_id'];
require_once('chart_data_function.php');

$taskRepo  =  new TaskRepository(DatabaseConnection::getInstance());
$stageRepo =  new StageRepository(DatabaseConnection::getInstance());
$tasks     =  $taskRepo  -> getAll();
$stages    =  $stageRepo -> ProjectID($id);
// $_SESSION['user_id'] = 
?>

<!Doctype html>
<head>
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- Include the JavaScript file -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
  <!-- custom chart.js  -->
   <script src="../js/charts.js"></script> 
<!-- cssloader -->
<link rel="stylesheet" href="../css/css_loader.css">

<!-- custom js   -->
<script src="../js/changecolor.js"></script>

  <!-- custom css  -->
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <!-- title logo  -->
    <link rel="icon" type="image/png" href="../image/logo2_2.PNG">

<!-- loader JavaScript -->
<!-- <script>
        // Hide the loader after 3 seconds
        setTimeout(function() {
            document.querySelector('.loader2').style.display = 'none';
            document.querySelector('.content').style.display = 'block'; // Show the content
        }, 3000);
    </script> -->

 </head>
 <body >
<!-- 
 <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="loader2"></div>
</div> -->
  <section class="Ysummary_des container-fluid ">
    <div class="row">

    </div>
    <div class="col-lg-12  ">
              <h6 class="pt-3 mb-0 text-secondary">Members</h6>
              <hr/>
              <?php
              // Get the task members from the repository
              $pjMemberRepository = new projectMemberRepository();
              $taskMembers = $pjMemberRepository->findWithProjectID($id);
            ?>
           
              <div class="Ycontainer">
              <div class="row  Yrow ">
              <?php foreach ($taskMembers as $taskMember) {
        // Get the user name for each task member
        $userName = taskMemberRepository::getUserName($taskMember);
        $chartstages  = $projectRepository->getPieBarChartLineData($id, $taskMember->user_id);
        
        ?>
                  <div class="col-lg-3 Ycol-lg-3">
                    <div class="Ymember_card ">
                      <div class="Ymember_img_name d-flex">
                      <div class="Ymember_img">
                            <img src="../image/<?=$userName->img?>" width="120px" height="50px">
                          </div>
                          <span class=" Ymember"> 
                              <?php $userName = taskMemberRepository::getUserName($taskMember);
                                  if ($userName !== null) {
                                      echo $userName->name . "<br>"; // Assuming 'name' is the property holding the user's name
                                  } else {
                                      echo "Unknown user<br>";
                                  }?>
                            </span>
                      </div>
              
                      <div class="YlineChart_home_page">
                      <canvas id="YmemberlineChart<?= $taskMember->user_id ?>"></canvas>
                      </div>

                    </div>

                  </div>
                  <script>
                document.addEventListener("DOMContentLoaded", function() {
                        // JavaScript code for generating pie chart


                        
                        var labels<?= $taskMember->user_id ?> = [];
                        var data<?= $taskMember->user_id ?> = [];
                        <?php foreach($chartstages as $stage): ?>
                            labels<?= $taskMember->user_id ?>.push("<?=$stage["stage"]?>");
                            data<?= $taskMember->user_id ?>.push("<?=$stage["count"]?>");
                          
                        <?php endforeach; ?>

                        generateLineChart_for_member('YmemberlineChart<?= $taskMember->user_id ?>', labels<?= $taskMember->user_id ?>, data<?= $taskMember->user_id ?>);

                    });
                </script>
                  <?php } ?>


        <!-- add more div 4 -->
                  </div>

                  <div class="Yscroll-buttons">
                      <span class="scroll-button prev "><i class="fa-solid fa-angles-left "></i></span>
                      <span class="scroll-button next"><i class="fa-solid fa-angles-right"></i></span>
                  </div>


              </div>
        <!-- /// -->
            


        <!-- // -->  
        <hr/>
                      
      </div>

      <div class="row">
            <div class="col-lg-4"> 
            

              <div class=" Ytask_table_div" >
              <h4 class="text-center mb-3 pt-3" >Total Tasks</h4>
    
          <table class="Ytask_table">
                  <tbody><tr>
                    <th class="Ypadding_left">Stages</th>
                    <th class="Ypadding_right">Tasks</th>
                  </tr>
                  <?php foreach ($stages as $stage):?>
                  <tr >
                      <td class="Ypadding_left"><?=$stage->name?></td>
                      <!-- change some code for table data(myo) -->
                      <td id="<?=$stage->name?>TaskCount" class="Ypadding_right">
                     
                      </td>
                  </tr>
                  <?php endforeach;?>

                  
              </tbody></table>
              </div>

           
            </div>

                  <div class="Ykanban_barchart col-lg-8">
                        <canvas id="YbarChart_from_kanban_board" class="YChart mt-3"></canvas>
                  </div>

      </div>


    </div>

  </section>
  
        <?php
        $id = intval($_GET["id"]);
        $prorepo = new ProjectRepository(DatabaseConnection::getInstance());
        $project = $prorepo->find($id);
      ?>

      <!-- <?php if(isset($_SESSION['laststageequaltotaltasks']) && $_SESSION['laststageequaltotaltasks']=="True"): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">MMSP</div>
        <strong>
      <?php endif; ?>
      <?php if(isset($_SESSION['laststageequaltotaltasks']) && $_SESSION['laststageequaltotaltasks']=="False"): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">Lee Bl
        </div>
        <strong>
      <?php endif; ?> -->
      <section class="column-container mb-5 container-fluid row">
      <?php
          foreach($stages as $stage):?>
<div class="col-lg-3 col-md-3-home col-sm-3">
    <!-- <div class="task-column" > -->
    <div class="task-column" id="<?=$stage->name?>">
              <h4 class="text-center"><?=$stage->name?></h4>
              <hr class="custom-hr" />
              <div id="s_<?=$stage->id?>" stage_id="<?=$stage->id?>" class="task-list drop_stage dropzone" ondrop="drop(event)" ondragleave="dragLeave(event);" ondragover="allowDrop(event)">
          
              <?php foreach($tasks as $t):?>
<div class="PjId" hidden>
      <input type="hidden" name="project_id" value="<?= $id ?>" id="project_id">
      </div>
<div class="userId" hidden>
<input type="hidden" name="user_id" value="<?= $userid ?>" id="user_id">
</div>
      <?php if ($t->project_id == $id && $t->stage_id == $stage->id):?>
        

        <div id="t_<?=$t->id?>" task_id="<?=$t->id?>" stage_id="<?=$stage->id?>" class="task-container <?=$t->task_priority_border?>" draggable="true" ondragstart="drag(event)">
        
        <div class="task-header <?=$t->task_priority_color?>">
        <form method="POST" action="../Functions4Kanban/DeleteTask.php?id="<?= $id ?>>
        <input type="hidden" name="task_id" value="<?= $t->id ?>">  
        <input type="hidden" name="project_id" value="<?= $id ?>" id="project_id">

        <div class="titleDeletIconDiv">
        <h5><?=$t->task_name?></h5>
        <!-- <p><i class="fa-solid fa-xmark" type="button" class="btn btn-primary" id="custom-alert-button"  data-toggle="modal" data-target="#modal<?=$t->id?>"></i></p> -->
        <div class="modal fade" id="modal<?=$t->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
        <div class="modal-header">
        <h5 class="modal-title" id="<?=$t->task_name?>"><?=$t->task_name?></h5>
        <button type="button" class="close YmodelCancelButton" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
                  <div class="modal-body">
                      Do you Want to Delete This Task?
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="button" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="button mt-1" name="DeleteTask" id="DeleteTask">Delete</button>
                  </div>
                                  </div>
                                </div>
                              </div> 
                      <!--  -->
                    </div>
         </form>
                    <div class="d-flex">

                    <div class="canvas-container">
                      <!-- for member close Priority(myo)  -->
                          <!-- <div class="candiv">
                              <canvas id="canvas1" width="25" height="25" class="canvas canvas1" data-color="#d16bca" data-cand="cand1" ></canvas>
                              <div class="YCanvasExtra YFirstExtra">1st Priority</div>
                            </div>
                          <div class="candiv">
                              <canvas id="canvas2" width="25" height="25" class="canvas canvas2" data-color="#795ce0" data-cand="cand2" ></canvas>
                              <div class="YCanvasExtra YSecondExtra">2nd Priority</div>
                          </div> 
                          <div class="candiv">
                              <canvas id="canvas3" width="25" height="25" class="canvas canvas3" data-color="#30d1d9" data-cand="cand3" ></canvas>
                              <div class="YCanvasExtra YThirdExtra">3rd Priority</div>
                          </div> -->
                    </div>

                        <div class="YsmallProfile" >
                          <div class="YsmallPS YsmallP1">
                            <img src="../image/p1.jpg"/>
                          </div>
                          <div class="YsmallPS YsmallP2">
                            <img src="../image/p2.jpg"/>
                          </div>
                          <div class="YsmallPS YsmallP3">
                            <img src="../image/p3.jpg"/>
                          </div>
                          <div class="YsmallPS YsmallPExtra"></div>
                        </div>
                    </div>
                </div>
                <div class="task-description-container">
                  <p><td><?=$t->short_description?></td></p>
                  <a href="detailTask_admin.php?id=<?= $t->id ?>" class="">Details</a>
                </div>
              </div>
    <?php endif;?>
<?php  endforeach; ?>
  </div>
  </div>
</div>

<?php endforeach; ?>

      
    </section>

    <!-- </section> -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




    <!-- <script src="js/app.js"></script> -->
    <script src="../js/changecolor.js"></script>
    <script src="../js/drag_drop.js"></script>
    <script src="../js/lightbox.js"></script>
   
    <?php 
    $isAdmin = true;
     require_once("$path/header_footer/footer.php");
    ?>

 <script>
    // Generate the bar chart
   
    generateBarChart("YbarChart_from_kanban_board", barChartData);//barChartData is from chart_data_function.php
       
</script> 

<script>
    // Initialize Bootstrap tooltips
    $(function () {
       $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
//   // Generate the line chart
//   var labels1 = [];
//     var data1 = [];
//     <?php foreach($member1 as $m): ?>
//         labels1.push("<?=$m["stage"]?>");
//         data1.push("<?=$m["task"]?>");
       
//     <?php endforeach; ?>

//     generateLineChart_for_member('YmemberlineChart1', labels1, data1);

// //for member2
//     var labels2 = [];
//     var data2 = [];
//     <?php foreach($member2 as $m): ?>
//         labels2.push("<?=$m["stage"]?>");
//         data2.push("<?=$m["task"]?>");
       
//     <?php endforeach; ?>

//     generateLineChart_for_member('YmemberlineChart2', labels2, data2);


// //for member3
//     var labels3 = [];
//     var data3 = [];
//     <?php foreach($member3 as $m): ?>
//         labels3.push("<?=$m["stage"]?>");
//         data3.push("<?=$m["task"]?>");
       
//     <?php endforeach; ?>

//     generateLineChart_for_member('YmemberlineChart3', labels3, data3);

// //for member4

//     var labels4 = [];
//     var data4 = [];
//     <?php foreach($member4 as $m): ?>
//         labels4.push("<?=$m["stage"]?>");
//         data4.push("<?=$m["task"]?>");
       
//     <?php endforeach; ?>

//     generateLineChart_for_member('YmemberlineChart4', labels4, data4);

// //for member5
//     var labels5 = [];
//     var data5 = [];
//     <?php foreach($member5 as $m): ?>
//         labels5.push("<?=$m["stage"]?>");
//         data5.push("<?=$m["task"]?>");
       
//     <?php endforeach; ?>

//     generateLineChart_for_member('YmemberlineChart5', labels5, data5);


// // //for member6
//     var labels6 = [];
//     var data6 = [];
//     <?php foreach($member6 as $m): ?>
//         labels6.push("<?=$m["stage"]?>");
//         data6.push("<?=$m["task"]?>");
       
//     <?php endforeach; ?>

//     generateLineChart_for_member('YmemberlineChart6', labels6, data6);


    
// // //for member7
// var labels7 = [];
//     var data7 = [];
//     <?php foreach($member7 as $m): ?>
//         labels7.push("<?=$m["stage"]?>");
//         data7.push("<?=$m["task"]?>");
       
//     <?php endforeach; ?>

//     generateLineChart_for_member('YmemberlineChart7', labels7, data7);


    
// // //for member6
// var labels8 = [];
//     var data8 = [];
//     <?php foreach($member8 as $m): ?>
//         labels8.push("<?=$m["stage"]?>");
//         data8.push("<?=$m["task"]?>");
       
//     <?php endforeach; ?>

//     generateLineChart_for_member('YmemberlineChart8', labels8, data8);


</script>



  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.row');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    const containerWidth = container.offsetWidth;
    const divs = document.querySelectorAll('.Ycol-lg-3');
    const divWidth = divs[0].offsetWidth;
    const numVisibleDivs = 4;
    let currentIndex = 0;


    const spaceBetweenCards =0; // Adjust this value as needed

    updateVisibility();

    prevButton.addEventListener('click', function () {
      if (currentIndex > 0) {
        currentIndex--;
        updateVisibility();
      }
    });

    nextButton.addEventListener('click', function () {
      if (currentIndex < divs.length - numVisibleDivs) {
        currentIndex++;
        updateVisibility();
      }
    });


function updateVisibility() {
  const firstVisibleIndex = currentIndex;
  const lastVisibleIndex = currentIndex + numVisibleDivs - 1;

  divs.forEach((div, index) => {
    const isVisible = index >= firstVisibleIndex && index <= lastVisibleIndex;
    const offset = index - firstVisibleIndex;
    div.style.transition = 'transform 0.5s ease-in-out';
    div.style.transform = isVisible ? 'translateX(0)' : `translateX(${offset * 100}%)`;
    div.style.display = isVisible ? 'inline-block' : 'none';
  });
}
});
</script>





  </body>
</html>

