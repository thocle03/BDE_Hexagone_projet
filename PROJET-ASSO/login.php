<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="article.css">
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link rel="stylesheet" type="text/css" href="./styles/login.css">
    <link rel="stylesheet" type="text/css" href="./styles/read.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <title>Connection</title>
</head>

<body>
    <?php
    /// NEED TO IMPLEMENT EMAIL CONFIRMATION AND MAKE SURE EMAIL DOMAIN EXISTS ! /// 


    require "./controllers/UserManager.php";
    require "./models/User.php";

    if ($_POST) {
        $existingAccount = False;
        if (isset($_POST["username"])) {
            $username = $_POST["username"];
        } else {
            $username = "empty";
            $existingAccount = True;
        }

        $userData = [
            "username" => $username,
            "password" => $_POST['password'],
            "email" => $_POST['email']
        ];


        $findExistingUser = new UserManager();
        $users = $findExistingUser->getAll();

        if (empty($userData['username'])) {
    ?> <script href="javascript:;">
                alert("Name is required")
            </script>
        <?php
            $existingAccount = True;
        }

        if (!preg_match("/^[a-zA-Z-' ]*$/", $userData['username'])) {
        ?> <script href="javascript:;">
                alert("Only letters and white spaces allowed")
            </script>
        <?php
            $existingAccount = True;
        }

        if (empty($userData['email'])) {
        ?> <script href="javascript:;">
                alert("Email is required")
            </script>
        <?php
            $existingAccount = True;
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
        ?> <script href="javascript:;">
                alert("Invalid email format")
            </script>
            <?php
            $existingAccount = True;
        }

        foreach ($users as $user) {
            if ($user->getUsername() == $userData['username']) {
                if ($userData['username'] == 'empty') { ?> <script href="javascript:;">
                        alert("This username is already taken !")
                    </script>
                <?php }
                $existingAccount = True;
                break;
            }
        }

        foreach ($users as $user) {
            if ($user->getEmail() == $userData['email'] && $existingAccount == False) {
                if ($userData['username'] == 'empty') { ?> <script href="javascript:;">
                        alert("This email address is already taken !")
                    </script>
                <?php }
                $existingAccount = True;
                break;
            }
        }

        if ($existingAccount == False) {
            $findExistingUser->add(new User($userData));
            echo "<script>window.location.href= 'login.php'</script>";
        }

        if ($existingAccount) {
            foreach ($users as $user) {
                if ($user->getEmail() == $userData['email'] && $user->getPassword() == $userData['password']){
            $_SESSION['username'] = $user->getUsername();
            $_SESSION["id"] = $user->getId();
            $_SESSION['status'] = $user->getStatus();
            echo "<script>window.location.href= 'index.php'</script>";
            }
        }
        ?> <script href="javascript:;">
        alert("Invalid Login!")
    </script>
    <?php
    }
}

    ?>

    <!--<button class="bouton"><a href="index.php"><strong>Home</strong></a></button>
    <button class="bouton"><a href="logout.php"><strong>Logout</strong></a></button>-->
    
    <div class="main">
    <a href="javascript:;" onclick="history.back()"><img class= "icon_2" src="./images/arrow.svg" alt="flèche retour"> </a>
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form method="post" autocomplete="off">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="username" id="username" placeholder="Username" required="">
                <input type="email" name="email" class="form-control" id="email" aria-describedby="email-help" placeholder="Email" required="" pattern=".+@ecole-hexagone\.com">
                <input type="password" name="password" id="password" placeholder="Password" required="">
                <input class="button" target="_blank" type="submit" value="Sign up"></input>
            </form>
        </div>
        <div class="login">
            <form method="post" autocomplete="off">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" id="email" placeholder="Email" required="" pattern=".+@ecole-hexagone\.com">
                <input type="password" id="password" name="password" placeholder="Password" required="" >
                <button class="button2" type="submit">Login</button>
            </form>
        </div>
    </div>

</body>

</html>