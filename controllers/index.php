<?php

namespace controllers;

// контролер
class Index extends base
{
    // шаблон
    public $layouts = "first_layouts";

    // экшен
    public function index()
    {
        $model = new \models\Users();
        $userInfo = $model->getUser();
        $this->template->vars('userInfo', $userInfo);
        $this->template->view('index');
    }
}
