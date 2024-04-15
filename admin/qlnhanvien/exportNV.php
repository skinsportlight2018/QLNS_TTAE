<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

include('../model/PHPSpreadsheet/vendor/autoload.php');

// connect database
require_once('../model/database.php');

// export file excel
$objSpreadsheet = new Spreadsheet();
$sheet = $objSpreadsheet->getActiveSheet();

// Định dạng cho tiêu đề và logo
$sheet->setCellValue('A1', 'DANH SÁCH NHÂN VIÊN TRUNG TÂM NGOẠI NGỮ AE');

// Merge và căn giữa tiêu đề
$sheet->mergeCells('A1:T1');
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Định dạng cho tiêu đề
$headerStyle = [
    'font' => ['bold' => true, 'color' => ['rgb' => '2C3D57']],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFFFFF']],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
];


$sheet->getStyle('A1')->applyFromArray($headerStyle);

// Định dạng cho tiêu đề
$sheet->getStyle('A1')->getFont()->setSize(20)->setBold(true);
$sheet->getStyle('A2')->getFont()->setSize(12)->setBold(true);

// Định dạng cho các cột
$columns = range('A', 'T');
foreach ($columns as $column) {
    $sheet->getColumnDimension($column)->setAutoSize(true);
}

// Thiết lập tiêu đề cho từng cột
$sheet->setCellValue('A2', 'STT');
$sheet->setCellValue('B2', 'Mã nhân viên');
$sheet->setCellValue('C2', 'Tên nhân viên');
$sheet->setCellValue('D2', 'Giới tính');
$sheet->setCellValue('E2', 'Ngày sinh');
$sheet->setCellValue('F2', 'Nơi sinh');
$sheet->setCellValue('G2', 'Số CMND');
$sheet->setCellValue('H2', 'Ngày cấp');
$sheet->setCellValue('I2', 'Nơi cấp');
$sheet->setCellValue('J2', 'Quốc tịch');
$sheet->setCellValue('K2', 'Dân tộc');
$sheet->setCellValue('L2', 'Tôn giáo');
$sheet->setCellValue('M2', 'Quê quán');
$sheet->setCellValue('N2', 'Tạm trú');
$sheet->setCellValue('O2', 'Loại nhân viên');
$sheet->setCellValue('P2', 'Trình độ');
$sheet->setCellValue('Q2', 'Chuyên môn');
$sheet->setCellValue('R2', 'Bằng cấp');
$sheet->setCellValue('S2', 'Chức vụ');
$sheet->setCellValue('T2', 'Trạng thái');

// Định dạng cho tiêu đề của từng cột
$headerStyle = [
    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2C3D57']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
];

$sheet->getStyle('A2:T2')->applyFromArray($headerStyle);

// Lấy dữ liệu từ cơ sở dữ liệu
$sql = "SELECT nv.id as id, manv, hinhanh, hotennv, gioitinh, ngaysinh, noisinh, cccd, ngaycap_cccd, noicap_cccd, quequan, tenquoctich, tendantoc, tentongiao, tamtru, tenloainv, tentrinhdo, tenchuyenmon, tenbangcap, tenchucvu, trangthai FROM nhanvien nv, quoctich qt, dantoc dt, tongiao tg, loai_nv lnv, trinhdo td, chuyenmon cm, bangcap bc, chucvu cv  WHERE nv.quoctich_id = qt.id AND nv.dantoc_id = dt.id AND nv.tongiao_id = tg.id AND nv.loai_nv_id = lnv.id AND nv.trinhdo_id = td.id AND nv.chuyenmon_id = cm.id AND nv.bangcap_id = bc.id AND  nv.chucvu_id = cv.id ORDER BY nv.id DESC";

$result = DATABASE::execute_query($sql);

$rowCount = 2;
$stt = 0;
foreach ($result as $row) {
    $rowCount++;
    $stt++;

    $gioiTinh = ($row['gioitinh'] == 1) ? 'Nam' : 'Nữ';
    $trangThai = ($row['trangthai'] == 1) ? 'Đang làm việc' : 'Đã nghỉ việc';

    $sheet->setCellValue('A' . $rowCount, $stt);
    $sheet->setCellValue('B' . $rowCount, $row['manv']);
    $sheet->setCellValue('C' . $rowCount, $row['hotennv']);
    $sheet->setCellValue('D' . $rowCount, $gioiTinh);
    $sheet->setCellValue('E' . $rowCount, date_format(date_create($row['ngaysinh']), 'd/m/Y'));
    $sheet->setCellValue('F' . $rowCount, $row['noisinh']);
    $sheet->setCellValue('G' . $rowCount, $row['cccd']);
    $sheet->setCellValue('H' . $rowCount, date_format(date_create($row['ngaycap_cccd']), 'd/m/Y'));
    $sheet->setCellValue('I' . $rowCount, $row['noicap_cccd']);
    $sheet->setCellValue('J' . $rowCount, $row['tenquoctich']);
    $sheet->setCellValue('K' . $rowCount, $row['tendantoc']);
    $sheet->setCellValue('L' . $rowCount, $row['tentongiao']);
    $sheet->setCellValue('M' . $rowCount, $row['quequan']);
    $sheet->setCellValue('N' . $rowCount, $row['tamtru']);
    $sheet->setCellValue('O' . $rowCount, $row['tenloainv']);
    $sheet->setCellValue('P' . $rowCount, $row['tentrinhdo']);
    $sheet->setCellValue('Q' . $rowCount, $row['tenchuyenmon']);
    $sheet->setCellValue('R' . $rowCount, $row['tenbangcap']);
    $sheet->setCellValue('S' . $rowCount, $row['tenchucvu']);
    $sheet->setCellValue('T' . $rowCount, $trangThai);

    $columns = range('A', 'T');
    foreach ($columns as $column) {
        $sheet->getStyle($column . $rowCount)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }
}

// Đặt múi giờ cho Việt Nam
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Lấy ngày hôm nay theo múi giờ của Việt Nam
$ngayHienTai = date('d/m/Y');

// Thêm ngày xuất ở phía dưới bảng dữ liệu
$ngayXuat = 'Ngày xuất: ' . $ngayHienTai;
$sheet->setCellValue('A' . ($rowCount + 1), $ngayXuat);
$sheet->mergeCells('A' . ($rowCount + 1) . ':T' . ($rowCount + 1));

// Định dạng cho ngày xuất
$styleNgayXuat = [
    'font' => ['bold' => true, 'color' => ['rgb' => '2C3D57']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT]
];

$sheet->getStyle('A' . ($rowCount + 1))->applyFromArray($styleNgayXuat);

// Tạo viền
$sheet->getStyle('A2:T' . $rowCount)->applyFromArray([
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
]);

// Lưu file Excel
$filename = 'DSnhanvien.xlsx';
$writer = new Xlsx($objSpreadsheet);
$writer->save($filename);

// Cấu hình khi xuất file
header('Content-Disposition: attachment; filename="' . $filename . '"'); // Trả về file dưới dạng attachment
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length: ' . filesize($filename));
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: no-cache');
readfile($filename);
return;
