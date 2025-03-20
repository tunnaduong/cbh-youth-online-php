<?php
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
include "env.php";
include "vendor/autoload.php";
include "common/route.php";
