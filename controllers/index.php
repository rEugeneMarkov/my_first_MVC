<?php

namespace controllers;

// контролер
class Index extends Base
{
    // шаблон
    public $layouts = "first_layouts";

    // экшен
    public function index()
    {
        $model = new \models\Index();
        $indexInfo = $model->getIndex();
        $this->template->vars('indexInfo', $indexInfo);
        $this->template->view('index');
    }
}
