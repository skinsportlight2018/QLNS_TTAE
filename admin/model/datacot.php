<?php

include_once '../model/luong.php';
include_once '../model/database.php';

// Lấy tháng và năm từ client
$selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
$selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Nếu yêu cầu lấy toàn bộ dữ liệu
if (isset($_GET['all']) && $_GET['all'] === 'true') {
    // Lấy dữ liệu từ cơ sở dữ liệu cho tất cả nhân viên
    $luong = new LUONG();
    $data = $luong->layToanBoLuongTheoNgay($selectedYear);
} else {
    // Lấy dữ liệu từ cơ sở dữ liệu cho tháng và năm đã chọn
    $luong = new LUONG();
    $data = $luong->layLuongTheoNgay(date('m', strtotime($selectedMonth)), $selectedYear);
}

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode(['data' => $data]);
