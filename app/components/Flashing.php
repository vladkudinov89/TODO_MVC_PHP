<?php

namespace App\Components;

class Flashing
{
    const INFO = 'i';
    const SUCCESS = 's';
    const WARNING = 'w';
    const ERROR = 'e';

    protected $msgTypes = [
        self::ERROR => 'error',
        self::WARNING => 'warning',
        self::SUCCESS => 'success',
        self::INFO => 'info',
    ];

    const defaultType = self::INFO;

    protected $redirectUrl = null;

    protected function doRedirect()
    {
        if ($this->redirectUrl) {
            header('Location: ' . $this->redirectUrl);
            exit();
        }
        return $this;
    }

    public function add($message, $type = self::defaultType, $redirectUrl = null)
    {
        $_SESSION['flash_messages'][$type] = ['message' => $message];

        if (!is_null($redirectUrl)) $this->redirectUrl = $redirectUrl;

        $this->doRedirect();

        return $this;
    }

    public
    function display()
    {
        $types = array_keys($this->msgTypes);

        foreach ($types as $type) {

            if (!isset($_SESSION['flash_messages'][$type]) || empty($_SESSION['flash_messages'][$type])) continue;
            $output = $_SESSION['flash_messages'];

            if (!is_null($output)) {
                unset($_SESSION['flash_messages'][$type]);
            }
            return $output;

        }

        return $this;
    }

    public
    function success($message, $redirectUrl = null)
    {
        return $this->add($message, self::SUCCESS, $redirectUrl);
    }

    public
    function error($message, $redirectUrl = null)
    {
        return $this->add($message, self::ERROR, $redirectUrl);
    }

    public
    function info($message, $redirectUrl = null)
    {
        return $this->add($message, self::INFO, $redirectUrl);
    }

    public
    function warning($message, $redirectUrl = null)
    {
        return $this->add($message, self::WARNING, $redirectUrl);
    }
}