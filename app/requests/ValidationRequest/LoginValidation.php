<?php
namespace App\Requests\ValidationRequest;

use App\Requests\Request;

class LoginValidation
{
    public function rules()
    {
        if (Request::exist()) {
            $validate = new Validation();
            $validation = $validate->check($_POST, array(
                'email' => array(
                    'required' => true,
                    'string' => true,
                    'email' => true,
                    'min' => 5,
                    'max' => 100,
                ),
                'password' => array(
                    'required' => true,
                    'string' => true,
                    'min' => 3,
                    'max' => 20,
                )
            ));
            return $validation;
        }
    }
}