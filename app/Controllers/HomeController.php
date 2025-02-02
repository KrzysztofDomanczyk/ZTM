<?php

namespace App\Controllers;

use Infrastructure\View;

class HomeController
{
    public function index(): void
    {
        (new View('home'))->render();
    }
}
