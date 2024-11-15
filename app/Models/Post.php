<?php

namespace App\Models;

use App\Models\BaseModel;

class Post extends BaseModel
{
    public function newsfeed()
    {
        $this->setQuery("SELECT * FROM cyo_topics ORDER BY created_at DESC");
        return $this->loadAllRows();
    }
}
