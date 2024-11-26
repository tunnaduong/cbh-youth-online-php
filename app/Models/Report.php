<?php

namespace App\Models;

use App\Models\BaseModel;

class Report extends BaseModel
{
    public function saveReport($class_id, $report_time, $absent, $cleanliness, $uniform, $mistake_id, $note) {
        // Tạo câu lệnh SQL
        $this->setQuery("INSERT INTO cyo_volunteer_daily_reports 
                        (class_id, report_time, absent, cleanliness, uniform, mistake_id, note) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Thực thi truy vấn
        $result = $this->execute([
            $class_id,
            $report_time,
            $absent,
            $cleanliness,
            $uniform,
            $mistake_id,
            $note
        ]);

        // Trả về ID của bản ghi vừa được thêm
        return $this->getLastId();
    }
}
