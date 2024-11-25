<?php

namespace App\Models;

use App\Models\BaseModel;

class OAuth extends BaseModel
{
    public function register($email, $name, $profile_picture)
    {
        $this->setQuery("");
    }
}
