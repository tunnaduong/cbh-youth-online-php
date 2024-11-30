<?php

namespace App\Controllers;

use App\Models\Report;

class ReportController extends BaseController
{
    protected $reportModel;

    public function __construct()
    {
        // Khởi tạo model
        $this->reportModel = new Report();
    }

    // Hiển thị form báo cáo
    public function showReportForm()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        if ($_SESSION['user']->role != 'volunteer' && $_SESSION['user']->role != 'admin') {
            return $this->render('errors.forbiddenReport');
        }

        // nếu url không phải là /report/class thì chuyển hướng về /report/class
        if ($_SERVER['REQUEST_URI'] != '/report/class') {
            header('Location: /report/class');
            exit;
        }

        $classes = $this->reportModel->getAllClasses(); // Lấy danh sách các lớp
        $mistakes = $this->reportModel->getAllMistakes(); // Lấy danh sách các lỗi vi phạm
        $this->render('report.index', [
            'classes' => $classes,
            'mistakes' => $mistakes
        ]);
    }

    // Xác nhận báo cáo
    public function confirmReport()
    {
        // Thu thập dữ liệu từ POST
        $data = [
            'class_id' => $_POST['class_id'],
            'report_time' => $_POST['report_time'],
            'absent' => $_POST['absent'],
            'cleanliness' => $_POST['cleanliness'],
            'uniform' => $_POST['uniform'],
            'mistake_id' => $_POST['mistake_id'],
            'note' => $_POST['note'],
        ];

        // Lấy thông tin bổ sung từ database để hiển thị
        $data['class_name'] = $this->reportModel->getClassNameById($data['class_id']);
        $data['mistake_name'] = $this->reportModel->getMistakeNameById($data['mistake_id']);

        $this->render('confirm_report', ['report' => $data]);
    }

    // Gửi báo cáo
    public function submitReport()
    {
        // Thêm báo cáo vào cơ sở dữ liệu
        $this->reportModel->saveReport($_POST['class_id'], $_POST['report_time'], $_POST['absent'], $_POST['cleanliness'], $_POST['uniform'], $_POST['mistake_id'], $_POST['note']);

        // Hiển thị thông báo thành công
        $this->render('report_success');
    }
}
