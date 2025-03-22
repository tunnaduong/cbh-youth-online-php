<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HelpCenterController extends BaseController
{
    public function index()
    {
        return $this->render('help-center.index');
    }
}
