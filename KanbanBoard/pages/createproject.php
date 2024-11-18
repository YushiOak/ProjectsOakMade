<?php 
$isCreateProject = true;
require_once('../header_footer/header.php');
$admin_id   = $_SESSION['user_id']; 
$stageError = isset($_SESSION['stageError']) ? $_SESSION['stageError'] : ''; 
require_once('../Repositories/StageRepository.php');
include('DB_connection.php');
// require_once('header&footer/footer.php');

$stageRepo = New StageRepository(DatabaseConnection::getInstance());

unset($_SESSION['stageError']);
?>
<!Doctype html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- custom css  -->
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <!-- <link rel="stylesheet" href="../css/Mistyle.css" /> -->
    <!-- title logo  -->
    <link rel="icon" type="../image/png" href="../image/logo2_2.PNG">

 </head>  
 <body class="MiYbody">
 <section class="Ycolumn-container MiYcolumn-container pb-5 ">
  <div class="row MiYrow d-flex justify-content-center"">
      
   <!-- picture slide-->
   <div class="col-lg-7  d-flex justify-content-center align-items-center">

<div id="carouselExampleSlidesOnly" class="carousel slide MiYimgspace ms-1" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../image/kb9.jpg" class="d-block w-100 rounded" alt="slide1">
    </div>
    <div class="carousel-item">
      <img src="../image/kb10.jpg" class="d-block w-100 rounded" alt="slide2">
    </div>
    <div class="carousel-item">
      <img src="../image/kb11.jpg" class="d-block w-100 rounded" alt="slide3">
    </div>
  </div>
</div>
</div>

     <!-- add  task -->
 <div class="col-lg-5">

<form action="../Functions4Kanban/projectcreate.php" method="POST">

 <div class="text"><h1 class="loginFormText mt-5 "> Create Project</h1></div>

   <!-- task name -->
 <div class="Yinput-container text-center">

<div>
  <input type="text" id="admin_id" name="admin_id" value="<?php echo $admin_id ?>" hidden><br>
</div>

 <input type="text" id="" name="projectName" class="Miinput-field mt-4" placeholder="Enter Project title" required><br>

          <!-- add member -->
          <div class="addmember">  
                <table class="searchtable">
                    <?php
                    $userRepo = new UserRepository(DatabaseConnection::getInstance());
                    $member = $userRepo->getAll();
                    ?>
                  <tr>
                    <td>
                      <!-- <input type="text" name="k" placeholder="search member to add" autocomplete="off" class="inputsearch mt-4 "> -->
                      <select id="tselect" class="select mt-2" placeholder="search member to add" name="members[]" multiple required>
                        <?php foreach ($member as $m) : ?>
                          <option value="<?php echo htmlspecialchars($m->id); ?>">
                            <?php echo htmlspecialchars($m->name); ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </td>
  
                      <!-- <td><input type="submit" name="" value="search" class="mt-4 buttonsearch"></td><br> -->
                  </tr>
                </table>  
              </div>

      <!-- stage -->
      <div class="select-con mt-4 ">
           <select id="select-tags" multiple data-placeholder="Type to add stage" class="select"  name="stages[]" multiple required>     
           <option>計画</option>
           <option>進行中</option>
           <option>完了</option>
           
       </select><?php if (isset($stageError)) echo '<div style="color:red;">'.$stageError.'</div>';?>
      </div>

            <!-- discription -->
            <textarea placeholder="description..." id="des" name="Description" class="Mitext_area mt-4" required></textarea><br>
          
            <!-- detail discription -->
            <textarea placeholder="detail description..." id="Detail_des" name="Detail_Description" class="Mitext_area mt-4" required></textarea>

            <div class="datecontainer ">
                  <div class="input-group mt-4 ">
                    <span class="input-group-text" id="basic-addon3">Choose your create date</span>
                    <input type="date" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="createDate" required>
                  </div>
              </div>
                
               <!-- target date -->   
              <div class="datecontainer">        
                <div class="input-group mt-3 " >
                  <span class="input-group-text" id="basic-addon3">Choose your target date</span>
                  <input type="date" class="form-control " id="basic-url" aria-describedby="basic-addon3" name="dueDate" required>
                </div>
              </div>
      </div>
  
       <div class="buttontask-container mt-4">
       <a href="add_project_admin.php" class="buttonlink"><button type="button" class="buttonMi " >Back</button></a>
       <button type="submit" class="buttonMi " >Create</button>

       </div>
</form>
</div>


 </div> 
</section>

<?php require_once('../header_footer/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script> 
<script src="../js/foraddtask_tomselect.js"></script>
<script src="../js/forstage_tomselect.js"></script>

  </body>

</html>