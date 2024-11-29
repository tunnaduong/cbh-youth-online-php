<?php

namespace App\Controllers;

use App\Models\Recording;
use App\Controllers\BaseController;

class RecordingController extends BaseController
{
    protected $recordingModel;

    public function __construct()
    {
        $this->recordingModel = new Recording();
    }

    public function index()
    {
        $recordings = $this->recordingModel->getRecordings();

        return $this->render('recording.index', [
            'recordings' => $recordings,
        ]);
    }
}
