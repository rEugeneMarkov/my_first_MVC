<?php

    //require $_SERVER['DOCUMENT_ROOT'] . "/pages/function.php";

if (isset($_POST['clear_session'])) {
    $_SESSION = [
        'email' => "",
    ];
    $_POST = [
        'email' => "",
    ];
}
if (isset($_POST['email']) && strlen($_POST['email']) > 0) {
    $email = htmlspecialchars(trim($_POST['email']));
    $pass = htmlspecialchars(trim($_POST['pass']));
    $pass = md5($pass);

    if ($user = get_user_by_email_and_pass($email, $pass)) {
        $_SESSION['email'] = $user['email'] ;
    } else {
        $_SESSION['email'] = "" ;
    }
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    $email = "";
}
if (strlen($email) > 0) {
    $user = get_user($email);
    $hello = 'Добро пожаловать ' . $user['name'];
    ?>
    <div style="text-align: center;">
        <form method="post">
         <?=$hello?>
        <button name="clear_session" type="submit"class="btn btn-info btn-group">Выйти</button>
        </form> 
    </div>
    <?php
} else {
    ?>
        <div style="text-align: center;">
            <form action="" method="post">
            <input type="email" name="email" placeholder="Введите email" class="form-group">
            <input type="password" name="pass" placeholder="Введите пароль" class="form-group">
            <button type="submit"class="btn btn-info btn-group">Войти</button>
            </form> 
        </div>
    <?php
}

