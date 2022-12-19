Test view <br/>
id: <?=$articleInfo['id'];?><br/>
name: <?=$articleInfo['name'];?>
<?php

/* namespace first;

class User
{
    public $name;
    public $email;
    public $pass;

    public function getUserName()
    {
        return "{$this->name}"
    }
}
$user = new User();
 */
//require $_SERVER['DOCUMENT_ROOT'] . "/pages/config.php";
require $_SERVER['DOCUMENT_ROOT'] . "/templates/header.php";

if (is_user_logined()) {
    if (isset($_POST['content'])) {
        $email = $_SESSION['email'];
        $content = htmlspecialchars(trim($_POST['content']));

        if (strlen($content) < 50) {
            $check = "Мин. длинна статьи 50 символов";
        } else {
            add_article($user['name'], $content, $email);
            $check = "Запись успешно сохранена!";
        }
    }
}
?>
<h1>Список статей</h1>

<?php

if (is_user_logined()) {
    $table = "articles";
    require $_SERVER['DOCUMENT_ROOT'] . "/templates/pagination.php";
    $result = get_table_content($table, $art, $kol);
    $row = $result->fetch_array();
    do {
        require $_SERVER['DOCUMENT_ROOT'] . "/templates/temp_content.php";
    } while ($row = $result->fetch_array());

    if (isset($_POST['content'])) {
        $check_success = "Запись успешно сохранена!";
        $check_comment = "Мин. длинна статьи 50 символов";

        if ($check == $check_comment) {
            echo '<div class="info alert alert-warning">' . $check_comment . '</div>';
            //$check = " ";
        } elseif ($check == $check_success) {
            echo '<div class="info alert alert-info">' . $check_success . '</div>';
            //$check = " ";
        }
    }
    ?>

<div id="form">
    <form action="" method="post">
        <p><textarea type="text" class="form-control" name="content" placeholder="Ваша статья"></textarea></p>
        <p><input type="submit" class="btn btn-info btn-block" value="Сохранить"></p>
    </form>
</div>

    <?php
} else {
    ?>
    <div class="note">
        <p style="color:white;background-color:red;text-align: center;">
            Нужно выполнить вход!
        </p>
    </div>
    <?php
}
?>
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php";
