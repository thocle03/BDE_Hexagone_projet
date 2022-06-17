<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="article.css">
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
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
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form method="post" autocomplete="off">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="username" id="username" placeholder="Username" required="">
                <input type="email" name="email" class="form-control" id="email" aria-describedby="email-help" placeholder="Email" required="" pattern="+@ecole-hexagone\.com">
                <input type="password" name="password" id="password" placeholder="Password" required="">
                <input class="button" target="_blank" type="submit" value="Sign up"></input>
            </form>
        </div>
        <div class="login">
            <form method="post" autocomplete="off">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" id="email" placeholder="Email" required="">
                <input type="password" id="password" name="password" placeholder="Password" required="" pattern="+@ecole-hexagone\.com">
                <button class="button2" type="submit">Login</button>
            </form>
        </div>
    </div>




    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Jost', sans-serif;
            background: linear-gradient(to bottom, #310046, #310046, #310046);
        }

        .main {
            width: 350px;
            height: 500px;
            background: red;
            overflow: hidden;
            background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
            border-radius: 10px;
            box-shadow: 5px 20px 50px #000;
        }

        #chk {
            display: none;
        }

        .signup {
            position: relative;
            width: 100%;
            height: 100%;
        }

        label {
            color: #fff;
            font-size: 2.3em;
            justify-content: center;
            display: flex;
            margin: 60px;
            font-weight: bold;
            cursor: pointer;
            transition: .5s ease-in-out;
        }

        input {
            width: 60%;
            height: 20px;
            background: #fff;
            justify-content: center;
            display: flex;
            margin: 20px auto;
            padding: 10px;
            border: none;
            outline: none;
            border-radius: 5px;
        }

        .button {
            width: 60%;
            height: 40px;
            margin: 10px auto;
            justify-content: center;
            display: block;
            color: #fff;
            background: #FFD200;
            font-size: 1em;
            font-weight: bold;
            margin-top: 20px;
            outline: none;
            border: none;
            border-radius: 5px;
            transition: .2s ease-in;
            cursor: pointer;
        }

        .button2 {
            width: 60%;
            height: 40px;
            margin: 10px auto;
            justify-content: center;
            display: block;
            color: #fff;
            background: #310046;
            font-size: 1em;
            font-weight: bold;
            margin-top: 20px;
            outline: none;
            border: none;
            border-radius: 5px;
            transition: .2s ease-in;
            cursor: pointer;
        }

        button:hover {
            background: #6d44b8;
        }

        .login {
            height: 460px;
            background: #FFD200;
            border-radius: 60% / 10%;
            transform: translateY(-180px);
            transition: .8s ease-in-out;
        }

        .login label {
            color: #573b8a;
            transform: scale(.6);
        }

        #chk:checked~.login {
            transform: translateY(-500px);
        }

        #chk:checked~.login label {
            transform: scale(1);
        }

        #chk:checked~.signup label {
            transform: scale(.6);
        }
    </style>
</body>

</html>
