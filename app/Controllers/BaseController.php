<?php

namespace App\Controllers;

use App\Models\OnlineUser;
use eftec\bladeone\BladeOne;

class BaseController
{
    protected function render($viewFile, $data = [])
    {
        // Handle user tracking
        $onlineModel = new OnlineUser();
        $onlineModel->track($_SESSION['user']->id ?? null, $_SESSION['is_hidden'] ?? 0);
        $onlineModel->updateMaxOnline();

        $viewDir = "./app/Views";
        $storageDir = "./storage";
        $blade = new BladeOne($viewDir, $storageDir, BladeOne::MODE_DEBUG);
        echo $blade->run($viewFile, $data);
    }
}
