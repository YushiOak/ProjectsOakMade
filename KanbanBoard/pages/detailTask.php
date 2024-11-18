<?php 
 $path = realpath(__DIR__ ."/../"); 
require_once("$path/header_footer/header.php");

?>
<head>
 <link rel="icon" type="image/png" href="../image/logo.PNG">
 <link rel="stylesheet" href="../css/style.css">
     <!--  <form class="input-container">
        <div class="fields">
          <input id="title" placeholder="title..." />
          <input id="description" placeholder="description..." />
        </div>
        <input type="submit" id="submit-button" />
      </form> -->

   
</head>
<body class="eibody">
    <h2 class="text-center text-white">Project1</h2>
    <hr>
    

    <section class="column-container">
      <div class="task-column" id="backlog">
        <h3><center>✔ Task</center> </h3>
        <hr class="custom-hr" />
        <table class="task-list">
  <form>

  <tr>
    <td>Task Name</td>
<td>Task1</td>
  </tr>

  <tr>
    <td>Task Member</td>
<td>Aung Aung </td>
  </tr>

  <tr>
    <td>Detail Description</td>
<td>Task1</td>
  </tr>

  <tr>
    <td>Priority</td>
<td>Task1</td>
  </tr>

  <tr>
    <td>Create Date</td>
<td>Task1</td>
  </tr>

  <tr>
    <td>Target Date</td>
<td>Task1</td>
  </tr>

  <tr>
    <td>Complete Date</td>
<td>Task1</td>
  </tr>

  </table> 
  <br>
  <button class="btndt btn-outline-dark  "><-Back</button>
</form>
        
      </div>
   </section>
  
    <!-- <script src="js/app.js"></script> -->

    <?php 
require_once("$path/header_footer/footer.php");

?>
  </body>

</html>
