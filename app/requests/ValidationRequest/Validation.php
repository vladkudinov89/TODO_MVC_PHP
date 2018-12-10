<?php

namespace App\Requests\ValidationRequest;

class Validation
{
    private
        $passed = false,
        $errors = array();

    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

                $value = trim($source[$item]);

                if ($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required");
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("{$item} must be maximum of {$rule_value} characters.");
                            }
                            break;
                        case 'email':
                            if (trim(filter_var($value, FILTER_VALIDATE_EMAIL))) {

                            } else {
                                $this->addError("{$item} must be email.");
                            }
                            break;
                        case 'string':
                           $string = trim(filter_var($value, FILTER_SANITIZE_STRING));
                            if (is_string($string) && trim($string) !== '') {

                            } else if (trim($string) === ''){
                                $this->addError("{$item} must be string.");
                            }
                            break;
                    }
                }
            }
        }

        if (empty($this->errors)) {
            $this->passed = true;
        }

        return $this;

    }

    private function addError($error)
    {
        $this->errors[] = $error;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function passed()
    {
        return $this->passed;
    }
}