<?php

namespace App\Controllers;

class Alert
{


    public function __construct($type, $msg)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['msg'] = [
            'type' => $type,
            'info' => $msg,
        ];
    }

    public static function showMsg()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['msg'])) {
            $alert = $_SESSION['msg'];
            unset($_SESSION['msg']);
            return $alert;
        } else {
            return false;
        }
    }
}
