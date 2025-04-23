<?php

namespace App\Controllers\Frontend;

class HomeController extends BaseController
{
    public function index(): string
    {
        return $this->renderView('home/index');
    }

    public function vehicles(): string
    {
        return $this->renderView('home/vehicles');
    }

    public function rent(): string
    {
        return $this->renderView('home/rent');
    }

    public function confirmation(): string
    {
        return $this->renderView('home/confirmation');
    }
}