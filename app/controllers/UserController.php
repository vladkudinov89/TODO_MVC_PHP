<?php

namespace App\Controllers;

use App\Models\User;
use App\Requests\Request;
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

        if (Request::get('signIn')) {

            $email = trim(filter_var(Request::get('email'), FILTER_SANITIZE_EMAIL));
            $password = trim(filter_var(Request::get('password'), FILTER_SANITIZE_STRING));

            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $errors[] = 'Your email/password are incorrect';
                $this->content['errors'] = $errors;
            } else {
                User::auth($userId);
                unset($errors);
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