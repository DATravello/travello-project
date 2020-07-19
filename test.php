<form action="" method="post">
    <input type="pwd" name="pwd">
    <button name="ok">ok</button>
</form>
<?php

$pwd = "abc";

$pwdin = $_POST["pwd"];

$pwd_hashed = password_hash($pwd, PASSWORD_ARGON2ID);

if (isset($_POST["ok"])) {
    if (password_verify($pwdin, $pwd_hashed)) {
        echo "<br>Match";
    } else {
        echo "<br>Unmatch";
    }
}

?>