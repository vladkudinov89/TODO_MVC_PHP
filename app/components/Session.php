<?php

namespace App\Components;

class Session
{
    protected $redirectUrl = null;

    protected function doRedirect()
    {
        if ($this->redirectUrl) {
            header('Location: ' . $this->redirectUrl);
            exit();
        }
        return $this;
    }

    public function add($message, $redirectUrl = null)
    {
        $_SESSION['flash_messages'] = ['message' => $message];

        if (!is_null($redirectUrl)) $this->redirectUrl = $redirectUrl;

        $this->doRedirect();

        return $this;
    }

    public function display()
    {
        if (isset($_SESSION['flash_messages'])) {
            $output = $_SESSION['flash_messages'];
            if (!is_null($output)) {
                unset($_SESSION['flash_messages']);
            }
            return $output;
        }

        return $this;
    }
}