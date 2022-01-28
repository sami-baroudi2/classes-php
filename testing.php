<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="user.php">
    <label for="login">Login</label><br>
    <input type="text" name="login" placeholder="login">
    <label for="password">Password</label><br>
    <input type="text" name="password" placeholder="password">
    <label for="email">Email</label><br>
    <input type="text" name="email" placeholder="email">
    <label for="firstname">Firstname</label><br>
    <input type="text" name="firstname" placeholder="firstname">
    <label for="lastname">Lastname</label><br>
    <input type="text" name="lastname" placeholder="lastname">
    <input type="submit" name="submit" value="Envoyer">
    </form>



    <?php 
    require 'user.php';
    $test = new User ;
    var_dump($test->getAllInfos());
    ?>
</body>
</html>