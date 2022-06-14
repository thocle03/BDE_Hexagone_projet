<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="article.css">*
    <title>Connection</title>
</head>
<body>
  <?php 

    /// NEED TO IMPLEMENT EMAIL CONFIRMATION AND MAKE SURE EMAIL DOMAIN EXISTS ! /// 
    
        function loadClass($class){
           

            require "$class.php";
        }

        spl_autoload_register("loadClass");
        if($_POST){ 
          session_start();

            $userData = [
            "username" => $_POST['username'],
            "password" => $_POST['password'],
            "email" => $_POST['email']
            ];

            $existingAccount = False;
            $findExistingUser = new UserManager();
            $users = $findExistingUser->getAll();

            if(empty($userData['username'])){
                ?> <script href="javascript:;">
                        alert("Name is required")
                    </script> <?php
                    $existingAccount = True;
            }

            if(!preg_match("/^[a-zA-Z-' ]*$/",$userData['username'])){
                ?> <script href="javascript:;">
                        alert("Only letters and white spaces allowed")
                    </script> <?php
                    $existingAccount = True;
            }

            if(empty($userData['email'])){
                ?> <script href="javascript:;">
                        alert("Email is required")
                    </script> <?php
                    $existingAccount = True;
            }
            
            if(!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)){
                ?> <script href="javascript:;">
                        alert("Invalid email format")
                    </script> <?php
                    $existingAccount = True;
            }
            
            foreach($users as $user){
                // echo  $user->getUsername()==$userData['username'] ? "1" : "2";
                if($user->getUsername()==$userData['username']){
                    ?> <script href="javascript:;">
                        alert("This username is already taken !")
                    </script> <?php
                    $existingAccount = True;
                    break;
                }
            }
            foreach($users as $user){
                if($user->getEmail()==$userData['email'] && $existingAccount == False){
                    ?> <script href="javascript:;">
                        alert("This email address is already taken !")
                    </script> <?php
                    $existingAccount = True;
                    break;
               } 
            }
            if($existingAccount == False){
                $findExistingUser->add(new User($userData));
                // echo "<script>window.location.href= 'index.php'</script>";
            }     
    }   
?>

    <button class="bouton"><a href="index.php"><strong>Home</strong></a></button>
    <button class="bouton"><a href="logout.php"><strong>Logout</strong></a></button>
    
    <form class="box" method="post" autocomplete="off">
      <h1>Login</h1> 
      <input type="text" name="username" id="username" placeholder="Username">
      <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
      <input type="password" name="password" id="passsword "placeholder="Password">
      <input target="_blank" type="submit" value="Login"></input>
    </form>




<style>
    .box{
    text-align: center;
    color: white;
    border-radius: 10px;   
}
</style>
</body>
</html>
