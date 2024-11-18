<?php 
    $path = realpath(__DIR__ ."/../"); 
    require_once("$path/header_footer/header.php");
    require_once("$path/Database/DatabaseConnection.php");
    require_once("$path/Repositories/UserRepository.php");
    //$projmemberRepo = new projectMemberRepository(DatabaseConnection::getInstance());
    $memberRepo = new UserRepository(DatabaseConnection::getInstance());
    $members = $memberRepo->getAll();;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- custom css  -->
    <link rel="stylesheet" href="../css/style.css" type="text/css">
   
    <!-- title logo  -->
    <link rel="icon" type="image/png" href="../image/logo2_2.PNG">



 </head>  
 <body class="YHomeBodyColor">

 <section class="Ycolumn-container MiYcolumn-container pb-5">
  
    <div class="container pt-3">

    <table class="table MiYtable text-center" >
  <thead>
    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Image </th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Role</th>
                        
                    </tr>
                </thead>
                    <tbody style="line-height: 70px;">
                        <?php foreach ($members as $m) : ?>
                            <tr id="listItem_<?=$m->id?>" style="color:white">
                                <td ><?= $m->id ?></td>
                                <td><img src="../image/<?=$m->img?>" style="max-width: 50px; max-height: 50px;"></td>
                                <td><?= $m->name ?></td>
                                <td><?= $m->email ?></td>  
                                <td><?= $m->getGender()->name ?></td>     
                                <td><?= $m->getRole()->name ?></td>

                                     
                            </tr>
                        <?php endforeach ?>
                    </tbody>
            </table>

            <div class="col-md-6">
            <a href="javascript:history.back()"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#79305a" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1"/>
        </svg></a>
    </div>

</section>

<!-- to call footer (myo) -->
    <?php 
     require_once("$path/header_footer/footer.php");
    ?>
    <!-- <script src="../js/lightbox.js"></script> -->

<script src="../js/password.js">        </script>
</body>
</html>
 