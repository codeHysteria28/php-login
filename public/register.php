<?php

require_once '../template/header2.php';

require '../src/sanitize.php';

if(isset($_POST['submit'])){
    try{
        require_once '../src/DbConnection.php';
        $username = sanitize($_POST['username']);
        $password = sanitize($_POST['password']);

        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $statement->bindParam(':password', $password_hash);
        $statement->execute();

        // redirect to login page
        header("Location: login.php");
        exit();
    }catch (PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}

if(isset($_POST['submit']) && $statement){
    echo "<br>";
    echo $username . ' successfully registered';
}

?>
<title>Register</title>
</head>

<body>
<h1>Create a new account</h1>

<form action="" method="POST">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required autofocus placeholder="Enter your username"/>
    <br/>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required placeholder="Enter your password"/>
    <br/>

    <input type="submit" name="submit" value="Register"/>
</form>
</body>
</html>

