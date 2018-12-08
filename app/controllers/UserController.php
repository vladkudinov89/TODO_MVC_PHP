<?php

namespace App\Controllers;

use App\Models\User;
use App\Views\MainView;

class UserController
{
    protected $view;
    protected $content;

    public function __construct()
    {
        $this->view = new MainView();
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {

            $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
            $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

            $errors = false;

            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $errors[] = 'Направильные данные для входа на сайт';
                $this->content['errors'] = $errors;
            } else {
                User::auth($userId);

                header("Location: /");
            }
        }

        $this->content['email'] = $email;
        $this->content['password'] = $password;
        $this->content['content'] = "user/login.tmpl";
        $this->view->generate($this->content);
    }

    public function actionLogout()
    {
        unset($_SESSION['user']);
        header("Location: /");
    }

}