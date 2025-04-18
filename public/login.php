<?php
require_once('../src/config.php');
session_start()
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="../css/signin.css">
    <title>Sign in</title>
</head>


<body>
<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" >Username</label>
        <input name="Username" type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword">Password</label>
        <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button name="Submit" value="Login" class="button" type="submit">Sign in</button>

    </form>
    <?php
    require '../src/sanitize.php';
    if(isset($_POST['Submit'])){
        require_once '../src/DbConnection.php';

        $username = sanitize($_POST['Username']);
        $password = sanitize($_POST['Password']);

        $sql = "SELECT * FROM users WHERE username = :username";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            $_SESSION['Username'] = $user['username'];
            $_SESSION['Active'] = true;
            header('Location: index.php');
            exit();
        }else
            echo "Incorrect username or password";
    }

    ?>
</div>
</body>
</html>
