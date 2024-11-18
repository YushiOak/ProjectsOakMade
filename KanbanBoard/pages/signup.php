<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban Board</title>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      
    <link rel="icon" type="image/png" href="../image/logo2_2.PNG">
    <!-- custom css  -->
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body class="fed1dc">
<div class="container-fluid row">
            <div class="col-lg-6  YloginImg ee92a9">
                <div class="Yimg  Yimg1"></div>
                <div class="Yimg  Yimg2"></div>
                <div class="Yimg  Yimg3"></div>
                <div class="Yimg  Yimg4"></div>
                <div class="Yimg  Yimg5"></div>

            </div>
    <div class="loginForm  col-lg-6 ee92a9 ">
        <form action="func4signup.php" method="POST">
            <h1 class="loginFormText"><img src="../image/logo3.png" width="120px" height="50px"></h1>
            <span class="Yloginspan">Welcome to our Kanban</span>
            <div class="Yinputfieldcenter ">
                <div class="mt-5 Yinputf">
                <input type="text" id="text" name="name" class="input-field " placeholder="Enter YourName" value="<?= isset($_SESSION['signup_data']['name']) ? htmlspecialchars($_SESSION['signup_data']['name']) : '' ?>">
                    <?php if (isset($_GET['NameEmpty'])): ?>
                        <p class="" style="color: red">Name is required</p>
                    <?php endif; ?>

                    <input type="email" id="email" name="email" class="input-field-psw  mt-5" placeholder="Enter Email" value="<?= isset($_SESSION['signup_data']['email']) ? htmlspecialchars($_SESSION['signup_data']['email']) : '' ?>">
                    <?php if (isset($_GET['EmailEmpty'])): ?>
                        <p class="" style="color: red ;">Email is required</p>
                    <?php elseif (isset($_GET['EmailExists'])): ?>
                        <p class="" style="color: red ;">This email is already in use</p>
                    <?php endif; ?>

                    <div class="psw-eye">
                        <input type="password" id="password" class="input-field-psw  mt-5" name="password" placeholder="Enter Password">
                        
                        <!-- change  from fa-eye to fa-eye-slash & mt mb for button and psw field (myo) -->
                        <i class="fas fasignup fa-eye-slash toggle-password" ></i>
                       
                        <?php if (isset($_GET['PasswordEmpty'])): ?>
                            <p class="" style="color: red ;">Password is required</p>
                        <?php endif; ?>
            </div>

        <div>
            <select class="input-field mt-5" id="gender" name="gender_id">
                 <!-- to made user can't choose gender option .. can only choose for Male & Female (myo) -->
                 <option selected disabled value="">Select Gender</option>
                <option value="1" <?= (isset($_SESSION['signup_data']['gender_id']) && $_SESSION['signup_data']['gender_id'] == '1') ? 'selected' : '' ?>>Male</option>
                <option value="2" <?= (isset($_SESSION['signup_data']['gender_id']) && $_SESSION['signup_data']['gender_id'] == '2') ? 'selected' : '' ?>>Female</option>
            </select>
            <?php if (isset($_GET['GenderEmpty'])): ?>
                <p class="text-info" style="color: red !important;">Gender is required</p>
            <?php endif; ?>
        </div>


                    <button type="submit" class="button mt-4">Sign Up</button>
                </div>
            </div> 
            <span class="Yloginspan mt-3">Already have an account? <a href="login.php" class="YColor3e306b">Login</a></span>
        </form>
    </div>
</div>
 <!-- seperate psw toggle eye js file(myo )   -->
 <script src="../js/psweyecloseopen.js"></script>
</body>
</html>
