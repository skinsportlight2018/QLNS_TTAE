<?php
require_once('../model/tcpdf/vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('../model/database.php');

class MYPDF extends TCPDF
{
    public function __construct()
    {
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    public function createPDF($data)
    {
        // Sắp xếp dữ liệu từ bé đến lớn theo cột STT (id)
        usort($data, function($a, $b) {
            return $a['id'] - $b['id'];
        });

        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('Trung tâm ngoại ngữ AE');
        $this->SetTitle('Danh sách nhân viên');
        $this->SetSubject('Danh sách nhân viên');
        $this->SetKeywords('PDF, danh sách, nhân viên');

        // Đặt kích thước trang A4
        $this->SetPageFormat('A4', 'L');
        $this->AddPage();

        // Không in header và footer
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);

        $this->Ln(5);

        // Thiết lập font và kích thước cho văn bản "CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM"
        $this->SetFont('dejavusans', 'B', 12);

        // Vẽ ô văn bản "CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM"
        $this->MultiCell(0, 10, 'TÊN CƠ SỞ                                                                                               CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM', 0, 'R');
        $this->Ln(-4);

        $this->SetFont('dejavusans', '', 10);

        // Vẽ ô văn bản "Trung tâm ngoại ngữ AE"
        $this->MultiCell(0, 5, 'TRUNG TÂM NGOẠI NGỮ AE', 0, 'L');

        $center_x_position = ($this->GetX() + $this->GetPageWidth()) / 2;
        $right_x_position = $center_x_position + 85; // Điều chỉnh giá trị 20 tùy theo khoảng cách bạn muốn di chuyển
        $this->Ln(-6);

        $this->SetFont('dejavusans', 'iU', 13);

        // Di chuyển con trỏ vẽ đến vị trí mới của "Ký ghi rõ họ tên" và căn giữa nó
        $this->SetXY($right_x_position - ($this->GetStringWidth('Độc lập - Tự do - Hạnh phúc') / 2), $this->GetY());
        $this->Cell(0, 10, 'Độc lập - Tự do - Hạnh phúc', 0, 1, 'L');

        $this->Ln(0);

        $this->SetFont('dejavusans', 'B', 13);
        $this->Cell(0, 10, 'BẢN KÊ KHAI DANH SÁCH NHÂN SỰ VÀ BẰNG CẤP CHUYÊN MÔN', 0, 1, 'C');
        $this->Ln(4);

        $center_x_position = $this->GetPageWidth() / 2;
        $this->SetFont('dejavusans', '', 12);

        $text = 'Cơ sở kinh doanh: ......................................................................................................................';
        $this->SetX($center_x_position - $this->GetStringWidth($text) / 2);
        $this->Cell(0, 5, $text, 0, 1, 'L');
        $this->Ln(2);

        $text = 'Họ tên chủ cơ sở: ...............................................................Số CCHND:......................................';
        $this->SetX($center_x_position - $this->GetStringWidth($text) / 2);
        $this->Cell(0, 5, $text, 0, 1, 'L');
        $this->Ln(2);

        $text = 'Địa điểm kinh doanh:.............................................................ĐT:...............................................';
        $this->SetX($center_x_position - $this->GetStringWidth($text) / 2);
        $this->Cell(0, 5, $text, 0, 1, 'L');

        $center_x_position = ($this->GetX() + $this->GetPageWidth()) / 2;
        $right_x_position = $center_x_position - 82; // Điều chỉnh giá trị 20 tùy theo khoảng cách bạn muốn di chuyển        $this->Cell(0, 5, 'Phạm vi kinh doanh:', 0, 1, 'L');
        $this->SetXY($right_x_position - ($this->GetStringWidth('Phạm vi kinh doanh:') / 2), $this->GetY());
        $this->Cell(0, 10, 'Phạm vi kinh doanh:', 0, 1, 'L');
        $this->Ln(0);

        // Thiết lập các cột trong bảng
        $header = array('STT', 'Tên nhân viên', 'Giới tính', 'Ngày sinh', 'Thường trú', 'Trình độ', 'Chuyên môn', 'Bằng cấp', 'Chức vụ');

        // Thiết lập định dạng cho bảng
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B', 9); 

        // Tạo header của bảng
        $w = array(12, 42, 18, 25, 30, 20, 40, 30, 30);
        $num_headers = count($header);
        // Tính tổng chiều rộng của các cột
        $total_width = array_sum($w);
        // Tính vị trí x để căn giữa bảng
        $table_x_position = ($this->GetPageWidth() - $total_width) / 2;
        $this->SetXY($table_x_position, $this->GetY());
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();

        // Thiết lập định dạng cho dòng dữ liệu
        $this->SetFont('dejavusans', '', 10);
        $this->SetFillColor(255);
        $this->SetTextColor(0);

        // Xuất dữ liệu từ cơ sở dữ liệu
        $fill = 0;
        foreach ($data as $row) {
            $this->SetX($table_x_position); // Đặt lại vị trí x về đầu bảng
            $this->Cell($w[0], 6, $row['id'], 'LRB', 0, 'C', $fill); // Thêm 'B' vào 'LR' để vẽ gạch ngang dưới
            $this->Cell($w[1], 6, $row['hotennv'], 'LRB', 0, 'L', $fill);
            if (isset($row['gioitinh'])) {
                $gioitinh = ($row['gioitinh'] == 1) ? 'Nam' : 'Nữ';
            } else {
                $gioitinh = ''; // Gán một giá trị mặc định nếu trường không tồn tại
            }

            $this->Cell($w[2], 6, $gioitinh, 'LRB', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row['ngaysinh'], 'LRB', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row['tamtru'], 'LRB', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row['tentrinhdo'], 'LRB', 0, 'L', $fill);
            $this->Cell($w[6], 6, $row['tenchuyenmon'], 'LRB', 0, 'L', $fill);
            $this->Cell($w[7], 6, $row['tenbangcap'], 'LRB', 0, 'L', $fill);
            $this->Cell($w[8], 6, $row['tenchucvu'], 'LRB', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
        }

        $this->Ln(1);

        $this->SetFont('dejavusans', 'I', 11);

        // Di chuyển con trỏ vẽ đến vị trí nơi bạn muốn vẽ ô "................, ngày....tháng....năm...."
        $this->Cell(0, 9, '.............., ngày....tháng.....năm.......', 0, 1, 'R');
        // Tính toán vị trí ngang cho ô chứa "Ký ghi rõ họ tên" để nó đứng giữa hai ô khác
        $center_x_position = ($this->GetX() + $this->GetPageWidth()) / 2;
        $this->Ln(-5);

        $this->SetFont('dejavusans', 'B', 10);

        // Di chuyển con trỏ vẽ đến vị trí nơi bạn muốn vẽ ô "Chủ cơ sở cam đoan khai đúng sự thật"
        $this->Cell(0, 10, 'Chủ cơ sở cam đoan khai đúng sự thật', 0, 1, 'R');

        // Di chuyển con trỏ vẽ xuống dưới 1 ô
        $this->Ln(-6);

        // Tính toán vị trí ngang mới cho "Ký ghi rõ họ tên" để nó được di chuyển sang phải chút
        $right_x_position = $center_x_position + 95; // Điều chỉnh giá trị 20 tùy theo khoảng cách bạn muốn di chuyển

        $this->SetFont('dejavusans', 'I', 10);

        // Di chuyển con trỏ vẽ đến vị trí mới của "Ký ghi rõ họ tên" và căn giữa nó
        $this->SetXY($right_x_position - ($this->GetStringWidth('Ký ghi rõ họ tên') / 2), $this->GetY());
        $this->Cell(0, 10, 'Ký ghi rõ họ tên', 0, 1, 'L');
    }
}



$pdf = new MYPDF();

$sql = "SELECT nv.id as id, manv, hinhanh, hotennv, gioitinh, ngaysinh, noisinh, cccd, ngaycap_cccd, noicap_cccd, quequan, tenquoctich, tendantoc, tentongiao, tamtru, tenloainv, tentrinhdo, tenchuyenmon, tenbangcap, tenchucvu, trangthai 
        FROM nhanvien nv, quoctich qt, dantoc dt, tongiao tg, loai_nv lnv, trinhdo td, chuyenmon cm, bangcap bc, chucvu cv  
        WHERE nv.quoctich_id = qt.id 
            AND nv.dantoc_id = dt.id 
            AND nv.tongiao_id = tg.id 
            AND nv.loai_nv_id = lnv.id 
            AND nv.trinhdo_id = td.id 
            AND nv.chuyenmon_id = cm.id 
            AND nv.bangcap_id = bc.id 
            AND nv.chucvu_id = cv.id 
        ORDER BY nv.id ASC"; // Sắp xếp từ bé đến lớn

$result = DATABASE::execute_query($sql);
$data = $result->fetchAll(PDO::FETCH_ASSOC);

$pdf->createPDF($data);

// Xuất file PDF ra màn hình hoặc tải về
$pdf->Output('danh_sach_nhan_vien.pdf', 'I');
?>
