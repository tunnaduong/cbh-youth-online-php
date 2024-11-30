<?php

namespace App\Models;

use App\Models\BaseModel;

class Report extends BaseModel
{
    public function saveReport($class_id, $report_time, $absent, $cleanliness, $uniform, $mistake_id, $note)
    {
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

    // Lấy tất cả các lớp
    public function getAllClasses()
    {
        $this->setQuery("SELECT * FROM cyo_school_classes");
        return $this->loadAllRows();
    }

    // Lấy tất cả lỗi
    public function getAllMistakes()
    {
        $this->setQuery("SELECT * FROM cyo_school_mistake_list");
        return $this->loadAllRows();
    }

    // Lấy tên lớp theo ID
    public function getClassNameById($class_id)
    {
        $this->setQuery("SELECT name FROM classes WHERE id = ?");
        return $this->loadRow([$class_id])->name ?? null;
    }

    // Lấy tên lỗi theo ID
    public function getMistakeNameById($mistake_id)
    {
        $this->setQuery("SELECT name FROM mistakes WHERE id = ?");
        return $this->loadRow([$mistake_id])->name ?? null;
    }
}
