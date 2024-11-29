<?php

namespace App\Models;

class Recording extends BaseModel
{
    public function getRecordings()
    {
        $this->setQuery("SELECT cr.title, cr.description, cr.audio_length, cr.created_at, cup.profile_name, ca.username, cup.verified, cup.oauth_profile_picture, cuc.file_path AS audio_path, cucp.file_path AS preview_path, cucpp.file_path AS profile_picture_path FROM cyo_recordings cr LEFT JOIN cyo_auth_accounts ca ON cr.user_id = ca.id LEFT JOIN cyo_user_profiles cup ON cup.auth_account_id = ca.id LEFT JOIN cyo_cdn_user_content cuc ON cuc.id = cr.cdn_audio_id LEFT JOIN cyo_cdn_user_content cucp ON cucp.id = cr.cdn_preview_id LEFT JOIN cyo_cdn_user_content cucpp ON cup.profile_picture = cucpp.id ORDER BY cr.created_at DESC");
        return $this->loadAllRows();
    }
}
