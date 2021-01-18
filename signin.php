<?php //Test file, expect bad practices and presentation (please don't mind the <br>)
    require_once __DIR__ . "/module/Database/User.php";
    require_once __DIR__ . "/module/function.php";
    session_start();

?>

<form method="POST">
    Surname: 
    <input type="text" name="surname" id="">
    Name:
    <input type="text" name="name" id="">
    <br>
    <br>
    Mail:
    <input type="email" name="email" id="">
    <br>
    <br>
    Password:
    <input type="password" name="hash">
    <button>Sign Up</button>
</form>

<br>
<br>
<br>

<a href="login.php">login</a>

<?php 
    if(!empty($_POST)) {

        //If you sanitize inputs you loose utf-8 specific character, keep this in mind in your projects
        $surname  = sanitize($_POST["surname"]);
        $name     = sanitize($_POST["name"]);
        $email    = sanitize($_POST["email"]);
        $password = trim($_POST["hash"]);

        $user          = new User();
        $user->surname = $surname;
        $user->name    = $name;
        $user->email   = $email;
        $user->hash    = password_hash($password, PASSWORD_BCRYPT);
        var_dump($user);

        if($user->add_user()) {

            $returned_value = $user->logIn();
            var_dump($returned_value);
            echo "Passed!";
        }
        else {
            echo "failed!";
        }
    }

?>
