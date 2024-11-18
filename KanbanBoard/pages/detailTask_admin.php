<?php 
$path = realpath(__DIR__ ."/../"); 
$isDetailTaskAdmin = true;

require_once("$path/header_footer/header.php");
require_once("$path/Repositories/ProjectRepository.php");
require_once("$path/Repositories/Task_memberRepository.php");
require_once("$path/Repositories/UserRepository.php");

$id = intval($_GET['id']); // Assuming task ID is passed via GET parameter

$user = new taskMemberRepository(DatabaseConnection::getInstance());
    $members = $user->find($id);
    $taskmemberrepo = new taskMemberRepository(DatabaseConnection::getInstance());
    $taskrepo       = new TaskRepository (DatabaseConnection::getInstance());
    $task = $taskrepo->find($id);
    $taskmember = $taskmemberrepo->findWithTaskID($id);

    $priority   = $taskrepo ->getPriorityName($task->task_priority_color);

?>
<html>
<head>
 <link rel="icon" type="image/png" href="../image/logo.PNG">
 <link rel="stylesheet" href="../css/style.css">
 <!-- title logo  -->
 <link rel="icon" type="image/png" href="../image/logo2_2.PNG">   
</head>
<body class="MiYcolumn-container">
    
    <section class="column-container mt-5">
      <div class="Ytask-detail pb-2 mb-5">
        <h3 class="text-center py-4">Task Details</h3>
        
        <table class="Ytask-detail-table">
            <tr>
              <td>Task Name</td>
              <td><?= $task ? $task->task_name : 'Task not found' ?></td>
            </tr>

            <tr>
            <td>Task Member</td>
            <td>
                <?php 
                // Assuming $task_id contains the ID of the task whose members you want to display
                $taskMemberRepo = new taskMemberRepository();
                $taskmembers = $taskMemberRepo->findWithTaskID($id);
                
                // Loop through task members and display their information
                if (!empty($taskmembers)) {
                    foreach ($taskmembers as $taskmember) {
                        $userName = taskMemberRepository::getUserName($taskmember);
                        if ($userName !== null) {
                            echo $userName->name . "<br>"; // Assuming 'name' is the property holding the user's name
                        } else {
                            echo "Unknown user<br>";
                        }
                    }
                } else {
                    echo "No task members found.";
                }
                ?>
            </td>

            <tr>
              <td>Short Description</td>
              <td><?= $task->short_description ?></td> <!-- Assuming $task->description holds the task description -->
            </tr>

            <tr>
              <td>Priority</td>
              <td><?= $priority ?></td> <!-- Assuming $task->priority holds the task priority -->
            </tr>
           
        </table> 
        <br>
        <a href="#" onclick="history.back();" class="buttonlink">
            <button type="button" class="button mt-1 Ypfchangebtn mb-5">Back</button>
        </a>
      </div>
   </section>
  
    <!-- <script src="js/app.js"></script> -->

    <?php 
require_once("$path/header_footer/footer.php");

?>
  </body>

</html>
