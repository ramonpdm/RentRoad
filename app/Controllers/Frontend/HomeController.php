<?php

namespace App\Controllers\Frontend;

class HomeController extends BaseController
{
    public function index(): string
    {
        return $this->renderView('home/index');
    }
}