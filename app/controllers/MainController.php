<?php

namespace app\controllers;

use app\Model\Message;;

class MainController extends \app\core\Controller {
    
    public function index() {
        return $this->view('Main/index');
    }

    public function aboutUs() {
        return $this->view('Main/about_us');
    }

}