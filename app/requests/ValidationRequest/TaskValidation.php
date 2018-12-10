<?php

namespace App\Requests\ValidationRequest;

use App\Requests\Request;

class TaskValidation
{
    public function rules()
    {
        if (Request::exist()) {
            $validate = new Validation();
            $validation = $validate->check($_POST, array(
                'taskname' => array(
                    'required' => true,
                    'string' => true,
                    'min' => 2,
                    'max' => 150,
                ),
                'tasktext' => array(
                    'required' => true,
                    'string' => true,
                    'min' => 5,
                    'max' => 350,
                )
            ));
            return $validation;
        }
    }
}