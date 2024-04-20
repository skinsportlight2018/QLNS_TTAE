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

// Lấy dữ liệu từ cơ sở dữ liệu
$sql = "SELECT maluong, nv.id as idNhanVien, hotennv, tenchucvu,luongngay, luongthang, ngaycong, phucap, khoannop, tamung, thuclanh, ngaychamcong FROM luong l, nhanvien nv, chucvu cv WHERE nv.id = l.nhanvien_id AND nv.chucvu_id = cv.id";

$result = DATABASE::execute_query($sql);

// Tạo hàm xuất dữ liệu vào từng sheet
function exportToSheet($sheetIndex, $thangNam, $data, $spreadsheet)
{
    $sheet = $spreadsheet->createSheet($sheetIndex); // Tạo một sheet mới
    $sheet->setTitle("Tháng $thangNam"); // Đặt tiêu đề cho sheet

    // Định dạng cho tiêu đề và logo
    $sheet->setCellValue('A1', "DANH SÁCH LƯƠNG NHÂN VIÊN TRUNG TÂM NGOẠI NGỮ AE THÁNG $thangNam");

    // Merge và căn giữa tiêu đề
    $sheet->mergeCells('A1:I1');
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $headerStyle = [
        'font' => ['bold' => true, 'color' => ['rgb' => '2C3D57']],
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFFFFF']],
        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
    ];
    $sheet->getStyle('A1')->applyFromArray($headerStyle);
    $sheet->getStyle('A1')->getFont()->setSize(20)->setBold(true);
    $sheet->getStyle('A2')->getFont()->setSize(12)->setBold(true);

    // Định dạng cho các cột
    $columns = range('A', 'I');
    foreach ($columns as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Thiết lập tiêu đề cho từng cột
    $sheet->setCellValue('A2', 'STT');
    $sheet->setCellValue('B2', 'Mã Lương');
    $sheet->setCellValue('C2', 'Tên nhân viên');
    $sheet->setCellValue('D2', 'Chức vụ');
    $sheet->setCellValue('E2', 'Lương ngày');
    $sheet->setCellValue('F2', 'Lương tháng');
    $sheet->setCellValue('G2', 'Ngày công');
    $sheet->setCellValue('H2', 'Thực lãnh');
    $sheet->setCellValue('I2', 'Ngày chấm công');

    // Định dạng cho tiêu đề của từng cột
    $headerStyle = [
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2C3D57']],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
    ];
    $sheet->getStyle('A2:I2')->applyFromArray($headerStyle);

    // Xuất dữ liệu vào từng hàng
    $rowCount = 2;
    $stt = 0;
    foreach ($data as $row) {
        $rowCount++;
        $stt++;

        $sheet->setCellValue('A' . $rowCount, $stt);
        $sheet->setCellValue('B' . $rowCount, $row['maluong']);
        $sheet->setCellValue('C' . $rowCount, $row['hotennv']);
        $sheet->setCellValue('D' . $rowCount, $row['tenchucvu']);
        $sheet->setCellValue('E' . $rowCount, number_format($row['luongngay']) . "vnđ");
        $sheet->setCellValue('F' . $rowCount, number_format($row['luongthang']) . "vnđ");
        $sheet->setCellValue('G' . $rowCount, $row['ngaycong']);
        $sheet->setCellValue('H' . $rowCount, number_format($row['thuclanh']) . "vnđ");
        $ngayChamCong = date('d/m/Y', strtotime($row['ngaychamcong']));
        $sheet->setCellValue('I' . $rowCount, $ngayChamCong);

        $columns = range('A', 'I');
        foreach ($columns as $column) {
            $sheet->getStyle($column . $rowCount)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }
        // Lấy đối tượng kiểu dáng của ô 'hotennv' và 'tenchucvu' và thiết lập căn trái
        $sheet->getStyle('B' . $rowCount)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('C' . $rowCount)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('D' . $rowCount)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    }

    // Đặt múi giờ cho Việt Nam
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    // Lấy ngày hôm nay theo múi giờ của Việt Nam
    $ngayHienTai = date('d/m/Y');

    // Thêm ngày xuất ở phía dưới bảng dữ liệu
    $ngayXuat = 'Ngày xuất: ' . $ngayHienTai;
    $sheet->setCellValue('A' . ($rowCount + 1), $ngayXuat);
    $sheet->mergeCells('A' . ($rowCount + 1) . ':I' . ($rowCount + 1));

    // Định dạng cho ngày xuất
    $styleNgayXuat = [
        'font' => ['bold' => true, 'color' => ['rgb' => '2C3D57']],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT]
    ];
    $sheet->getStyle('A' . ($rowCount + 1))->applyFromArray($styleNgayXuat);

    // Tạo viền
    $sheet->getStyle('A2:I' . $rowCount)->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ],
    ]);
}

// Tạo mảng để lưu dữ liệu của từng tháng và năm
$sheets = [];

// Phân loại dữ liệu vào từng tháng và năm
foreach ($result as $row) {
    $thangNam = date('m-Y', strtotime($row['ngaychamcong']));
    if (!isset($sheets[$thangNam])) {
        $sheets[$thangNam] = [];
    }
    $sheets[$thangNam][] = $row;
}

// Xuất dữ liệu vào từng sheet tương ứng
$sheetIndex = 0;
foreach ($sheets as $thangNam => $data) {
    exportToSheet($sheetIndex++, $thangNam, $data, $objSpreadsheet);
}

// Lưu file Excel
$filename = 'DSLuong.xlsx';
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
?>
