<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function actionLogin()
    {
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            // Валидация полей
//            if (!User::checkEmail($email)) {
//                $errors[] = 'Неправильный email';
//            }
//            if (!User::checkPassword($password)) {
//                $errors[] = 'Пароль не должен быть короче 6-ти символов';
//            }

            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $errors[] = 'Направильные данные для входа на сайт';
            } else {
                User::auth($userId);

                header("Location: /");
            }
        }

        require_once(ROOT . '/views/user/login.php');

        return true;
    }

    public function actionLogout()
    {
        unset($_SESSION['user']);
        header("Location: /");
    }

}