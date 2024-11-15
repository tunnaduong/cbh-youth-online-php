<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        return $this->render('home.index');
    }

    public function report()
    {
        return $this->render('report.index');
    }

    public function lookup()
    {
        return $this->render('lookup.index');
    }

    public function explore()
    {
        return $this->render('explore.index');
    }
}
