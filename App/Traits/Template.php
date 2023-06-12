<?php

namespace App\Traits;

use Slim\Views\Twig;

trait Template
{
    public function getTwig()
    {
        try {
            return Twig::create(TEMP_VIEW);
        } catch (\Throwable $th) {
            print_r($th);
        }
    }

    public function setView($name)
    {
        return $name . EXT_VIEWS;
    }
}
