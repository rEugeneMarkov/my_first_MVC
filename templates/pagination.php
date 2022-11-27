<?php
    /*
    $kol - количество записей для вывода
    $art - с какой записи выводить
    $total - всего записей
    $page - текущая страница
    $str_pag - количество страниц для пагинации
    */

    // Пагинация

    // Текущая страница
if (isset($_GET['page'])) {
        $page = $_GET['page'];
} else {
        $page = 1;
}

    $kol = 2;  // количество записей для вывода
    $art = ($page * $kol) - $kol;
    //echo $art;

    // Определяем все количество записей в таблице
    $total = get_table_count($table);
    // всего записей
    //echo $total;

    // Количество страниц для пагинации
    $str_pag = ceil($total / $kol);
    //echo $str_pag;

    // формируем пагинацию
if ($page > 1) {
    $previus_page = $page - 1;
} else {
    $previus_page = $page;
}
if ($page < $str_pag) {
    $next_page = $page + 1;
} else {
    $next_page = $page;
}
?>
    <div style="text-align: center;">
        <nav>
            <ul class="pagination">
            <li>
                <a href="?page=<?=$previus_page?>"  aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            for ($i = 1; $i <= $str_pag; $i++) {
                if ($i == $page) {
                    ?>
                    <li class="active"><a href="?page=<?= $i?>"> <?= $i?> </a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="?page=<?= $i?>"> <?= $i?> </a></li>
                    <?php
                }
            }
            ?>
            <li>
                <a href="?page=<?= $next_page?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
    </ul>
    </nav>
    </div>
    