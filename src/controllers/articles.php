<?php

namespace controllers;

// контролер
class Articles extends Base
{
    // шаблон
    public $layouts = "first_layouts";

    // экшен
    public function index()
    {
        $model = new \models\Articles();
        $articleInfo = $model->getArticle();
        $this->template->vars('articleInfo', $articleInfo);
        $this->template->view('articles');
    }
}
