<?php

namespace App\Models;

class Profile extends BaseModel
{
    public function getProfile($username)
    {
        $this->setQuery("SELECT * FROM cyo_auth_accounts ca INNER JOIN cyo_user_profiles cu ON ca.username = cu.profile_username LEFT JOIN cyo_cdn_user_content cuc ON cu.profile_picture = cuc.id WHERE username = ?");
        return $this->loadRow([$username]);
    }
}
