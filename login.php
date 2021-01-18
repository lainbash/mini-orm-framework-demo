<?php //Login demonstration
    require_once __DIR__ . "../module/Database/User.php";
    require_once __DIR__ . "../module/function.php";
    session_start();
?>

<form method="POST">
    Email:
    <input type="email" name="email" id="">
    Password:
    <input type="password" name="hash">
    <button>Se connecter</button>
</form>

<!-- don't mind these, the login page is just an exemple -->
<br>
<br>
<br>

<a href="signin.php">Sign in</a>


<?php //of course, business logic should be separeted from rendering, don't mind it too much in this case
    if(!empty($_POST)) {
        $email    = sanitize($_POST["email"]);
        $password = trim($_POST["hash"]);

        var_dump($_POST);

        $user        = new User();
        $user->email = $email;
        $user->hash  = $password;

        $query = $user->logIn();
        
        var_dump($query);
        if($query) {
            
            $user->populate($query);
            $_SESSION["current_user"] = serialize($user); // for example, don't forget to unserialize it when retrieving the data;
            echo "Passed!";
        }
        else {
            echo "Failed!!";
        }
        var_dump($user);
        var_dump($_SESSION);
        
    }

?>
