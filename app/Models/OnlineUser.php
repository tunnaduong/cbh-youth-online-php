<?php

namespace App\Models;

class OnlineUser extends BaseModel
{
    protected $table = 'cyo_online_users';

    public function track($userId = null, $isHidden = 0)
    {
        $sessionId = session_id();
        $ip = $_SERVER['REMOTE_ADDR'];
        $now = date('Y-m-d H:i:s');

        // Kiểm tra đã có chưa
        $this->setQuery("SELECT * FROM $this->table WHERE session_id = ?");
        $existing = $this->loadRow([$sessionId]);

        if ($existing) {
            $this->setQuery("UPDATE $this->table SET last_activity = ?, user_id = ?, is_hidden = ? WHERE session_id = ?");
            $this->execute([$now, $userId, $isHidden, $sessionId]);
        } else {
            $this->setQuery("INSERT INTO $this->table (session_id, user_id, is_hidden, last_activity, ip_address) VALUES (?, ?, ?, ?, ?)");
            $this->execute([$sessionId, $userId, $isHidden, $now, $ip]);
        }

        // Dọn session cũ (quá 5 phút)
        $this->setQuery("DELETE FROM $this->table WHERE last_activity < NOW() - INTERVAL 5 MINUTE");
        $this->execute();
    }

    public function getStats()
    {
        $this->setQuery("SELECT user_id, is_hidden FROM $this->table WHERE last_activity >= NOW() - INTERVAL 5 MINUTE");
        $users = $this->loadAllRows();

        $registered = 0;
        $hidden = 0;
        $guests = 0;

        foreach ($users as $user) {
            if ($user->user_id) {
                if ($user->is_hidden) $hidden++;
                else $registered++;
            } else {
                $guests++;
            }
        }

        return (object) [
            'total' => count($users),
            'registered' => $registered,
            'hidden' => $hidden,
            'guests' => $guests,
        ];
    }

    public function updateMaxOnline()
    {
        $stats = $this->getStats();
        $total = $stats->total;

        $this->setQuery("SELECT * FROM cyo_online_record LIMIT 1");
        $record = $this->loadRow();

        if (!$record || $total > $record->max_online) {
            if ($record) {
                $this->setQuery("UPDATE cyo_online_record SET max_online = ?, recorded_at = NOW() WHERE id = 1");
                $this->execute([$total]);
            } else {
                $this->setQuery("INSERT INTO cyo_online_record (id, max_online, recorded_at) VALUES (1, ?, NOW())");
                $this->execute([$total]);
            }
        }
    }

    public function getMaxOnline()
    {
        $this->setQuery("SELECT * FROM cyo_online_record LIMIT 1");
        return $this->loadRow(); // stdClass
    }
}
