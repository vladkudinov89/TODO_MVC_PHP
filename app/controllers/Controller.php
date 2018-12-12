<?php
namespace App\Controllers;

use App\Components\Session;
use App\Views\MainView;

class Controller
{
    protected $session;
    protected $view;

    public function __construct()
    {
        $this->session = new Session();
        $this->view = new MainView();
    }
}