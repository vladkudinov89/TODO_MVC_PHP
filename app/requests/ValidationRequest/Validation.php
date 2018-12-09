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