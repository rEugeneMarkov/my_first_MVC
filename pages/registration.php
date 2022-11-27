<?php
//require $_SERVER['DOCUMENT_ROOT'] . "/pages/config.php";
require $_SERVER['DOCUMENT_ROOT'] . "/templates/header.php";
?>

<h1>Регистрация</h1>

<?php
if (is_user_logined()) {
    $logined = "Вы уже выполнили вход.";
    ?>
    <div class="text-success"><?=$logined?></div>
    <?php
} else {
    if (isset($_POST['name_reg'])) {
        $name = htmlspecialchars(trim($_POST['name_reg']));
        $email = htmlspecialchars(trim($_POST['email_reg']));
        $pass = htmlspecialchars(trim($_POST['pass_reg']));
        $error_username = "";
        $error_email = "";
        $error_pass = "";
        $success = "";

        //$new_url = 'reg_test.php';

        if (strlen($name) <= 1) { // проверка имени
            $error_username = "Введите корректное имя";
        } elseif (strlen($email) < 7) { //проверка почты
            $error_email = "Введите корректную почту";
        } elseif (is_email_exists($email)) { // проверка почты на наличие в базе
            $error_email = "Такой пользователь уже зарегистрирован";
        } elseif (strlen($pass) < 6) {
            $error_pass = "Минимальная длинна пароля 6 символов";
        } else {
            register_user($name, $email, $pass);
            $success = "Вы успешно зарегистрировались!";
        }
    } else {
        $name = "";
        $email = "";
        $error_username = "";
        $error_email = "";
        $error_pass = "";
        $success = "";
    }
    ?>
        <div id="form">
        <div class="text-success"><?=$success?></div>
            <form action="" method="post">
                <p><input type="text" name="name_reg" value="<?=$name?>" 
                    placeholder="Введите имя" class="form-control"></p>
                <div class="text-danger"><?=$error_username?></div><br>
                <p><input type="email" name="email_reg" value="<?=$email?>" 
                    placeholder="Введите email" class="form-control"></p>
                <div class="text-danger"><?=$error_email?></div><br>
                <p><input type="password" name="pass_reg" placeholder="Введите пароль" class="form-control"></p>
                <div class="text-danger"><?=$error_pass?></div><br>
                <p><input type="submit" class="btn btn-info btn-block" value="Зарегистрироваться"></p>
            </form> 
        </div>
   
        <?php
}
        require $_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php";
