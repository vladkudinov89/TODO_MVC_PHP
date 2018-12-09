<?php
namespace App\Requests;

use App\Requests\ValidationRequest\Validation;

class TaskValidation
{
    public function rules()
    {
        if (Request::exist()) {
                $validate = new Validation();
                $validation = $validate->check($_POST, array(
                    'taskname' => array(
                        'required' => true,
                        'min' => 2,
                        'max' => 150,
                    ),
                    'tasktext' => array(
                        'required' => true,
                        'min' => 5,
                        'max' => 350,
                    )
                ));
            return $validation;
            }
    }
}