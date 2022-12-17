<?php

//namespace Test;

// контролер
class Controller_Index extends Controller_Base
{
    // шаблон
    public $layouts = "first_layouts";

    // экшен
    public function index()
    {
        $model = new \Test\Model_Users();
        $userInfo = $model->getUser();
        $this->template->vars('userInfo', $userInfo);
        $this->template->view('index');
    }
}
