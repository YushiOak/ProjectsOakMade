<?php 
    $path = realpath(__DIR__ ."/../"); 
    require_once("$path/header_footer/header.php");
    require_once("$path/Database/DatabaseConnection.php");
    require_once("$path/Repositories/UserRepository.php");
    //$projmemberRepo = new projectMemberRepository(DatabaseConnection::getInstance());
    $memberRepo = new UserRepository(DatabaseConnection::getInstance());
    $members = $memberRepo->getAll();
    
    

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
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <!-- <th onclick="togglePassword()">Password</th> -->
                        <th scope="col">Gender</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php foreach ($members as $m) : ?>
                            <tr id="listItem_<?=$m->id?>" style="color:white">
                                <td ><?= $m->id ?></td>
                                <td><img src="../image/<?=$m->img?>" style="max-width: 50px; max-height: 50px;"></td>
                                <td><?= $m->name ?></td>
                                <td><?= $m->email ?></td>  
                                <!-- <td data-password="<?= $m->password ?>">***</td>    -->
                                <td><?= $m->getGender()->name ?></td>     
                                <td><?= $m->getRole()->name ?></td>

                                <td>
                                
                                <a href="edit_memberlistpage.php?uid=<?=$m->id?>" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                                  </a>


                                <p type="button" class="mt-3 btn btn-danger" data-toggle="modal" data-target ="#<?=$m->id?>">
                                
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                </svg></a></p>
                                <div class="modal fade" id="<?=$m->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">

                                  <div class="modal-content ">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="text">Are you sure??</h5>
                                      <button type="button" class="close YmodelCancelButton" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>

                                    <div class="modal-body">
                                      Do you Want to Delete This member?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="button " data-dismiss="modal">Cancel</button>
                                      <button type="button" class="button mt-1" onclick="KdeleteMember(<?=$m->id?>)"> Delete</button>
                                        <!-- <a href="delete_memberlist.php?id=<?=$m->id?>"></a> -->
                                       
                                    </div>
                                  </div>
                                </div>
                              </div>
                              </div>
                            </td>      
                            </tr>
                        <?php endforeach ?>
                    </tbody>
            </table>

         <div class="col-md-6">
            <a href="javascript:history.back()"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#79305a" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1"/>
        </svg></a>
        

        </div>
        <br>

        

    </div>
    </section>



</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../js/changecolor.js"></script>
    <!-- <script src="../js/lightbox.js"></script> -->

<script>

        function togglePassword() {
            // Get all the password cells
            var passwordCells = document.querySelectorAll('td[data-password]');

            // Toggle the visibility of the password value for each password cell
            passwordCells.forEach(function(cell) {
                if (cell.textContent === '***') {
                    // Get the actual password value from the "data-password" attribute
                    var password = cell.getAttribute('data-password');
                    cell.textContent = password; // Display the actual password value
                } else {
                    cell.textContent = '***'; // Hide the password value and display asterisks
                }
            });
        }
        </script>

<?php 
     require_once('../header_footer/footer.php');
    ?>
</body>
</html>
 