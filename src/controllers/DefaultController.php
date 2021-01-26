<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->requireLogin(false);
        $this->render('login');
    }

    public function settings() {
        $this->requireLogin();
        $this->render('settings');
    }

}