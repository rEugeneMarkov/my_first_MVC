<?php
//require $_SERVER['DOCUMENT_ROOT'] . "/pages/config.php";
require $_SERVER['DOCUMENT_ROOT'] . "/templates/header.php";

if (is_user_logined()) {
    if (isset($_POST['comment'])) {
        $comment = htmlspecialchars(trim($_POST['comment']));
        $new_url = '/';
        if (strlen($comment) < 50) {
            $check = "Мин. длинна комментария 50 символов";
        } else {
            $email = $_SESSION['email'] ?? '';
            add_comment($user['name'], $comment);
            $check = "Запись успешно сохранена!";
        }
    }
}
?>
        
    <h1>Гостевая книга</h1>

    <?php
    $table = "exemple-first";
    require $_SERVER['DOCUMENT_ROOT'] . "/templates/pagination.php";
    $result = get_table_content($table, $art, $kol);
    while ($row = $result -> fetch_assoc()) {
        require $_SERVER['DOCUMENT_ROOT'] . "/templates/temp_content.php";
    }

    if (is_user_logined()) {
        $check_success = "Запись успешно сохранена!";
        $check_comment = "Мин. длинна комментария 50 символов";
        if (isset($_POST['comment'])) {
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
                <p><textarea type="text" class="form-control" name="comment" placeholder="Ваш отзыв"></textarea></p>
                <p><input type="submit" class="btn btn-info btn-block" value="Сохранить"></p>
            </form>
        </div>
        <?php
    }
    ?>
            
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php";
?>

