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
        $registrationInfo = $model->getRegistration();
        $this->template->vars('registrationInfo', $registrationInfo);
        $this->template->view('registration');
    }
}
