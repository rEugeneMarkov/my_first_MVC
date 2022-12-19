<?php

namespace controllers;

// контролер
class Registration extends Base
{
    // шаблон
    public $layouts = "first_layouts";

    // экшен
    public function index()
    {
        $model = new \models\Registration();
        $articleInfo = $model->getArticle();
        $this->template->vars('articleInfo', $articleInfo);
        $this->template->view('registration');
    }
}
