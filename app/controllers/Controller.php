<?php
namespace App\Controllers;

use App\Components\Flashing;
use App\Views\MainView;

class Controller
{
    protected $session;
    protected $view;

    public function __construct()
    {
        $this->session = new Flashing();
        $this->view = new MainView();
    }
}