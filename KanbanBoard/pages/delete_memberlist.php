<?php
$path = realpath(__DIR__ ."/../"); 
require_once("$path/Repositories/UserRepository.php");
require_once("$path/Database/DatabaseConnection.php");
?>
<?php
    
        $userRepo = new UserRepository(DatabaseConnection::getInstance());
        $result = $userRepo->delete($_GET['id']);
        if($result){
            header("Location: memberlist.php");
        }  
    
   
?> 





