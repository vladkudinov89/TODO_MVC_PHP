<?php

namespace App\Controllers;

use App\Models\User;
use App\Requests\Request;
use App\Requests\ValidationRequest\LoginValidation;
use App\Views\MainView;

class UserController
{
    protected $view;
    protected $content;
    private $loginValidation;

    public function __construct()
    {
        $this->view = new MainView();
        $this->loginValidation = new LoginValidation();
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';

        if (Request::get('signIn')) {

            if ($this->loginValidation->rules()->passed()) {

                $userId = User::checkUserData(Request::get('email'), Request::get('password'));

                if ($userId == false) {
                    $errors[] = 'Your email/password are incorrect';
                    $this->content['errors'] = $errors;
                } else {
                    User::auth($userId);
                    unset($errors);
                    header("Location: /");
                }
            } else {
                $this->content['errors'] = $this->loginValidation->rules()->errors();
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