<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RecordingController extends BaseController
{
    public function index()
    {
        return $this->render('recording.index');
    }
}
