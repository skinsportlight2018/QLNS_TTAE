    <?php
    class CONGTAC
    {

        // khai báo các thuộc tính
        private $id;
        private $macongtac;
        private $nhanvien_id;
        private $ngaybd;
        private $ngaykt;
        private $diadiem;
        private $nhiemvu_congtac;
        private $ghichu;

        public function getid()
        {
            return $this->id;
        }
        public function setid($value)
        {
            $this->id = $value;
        }

        public function getmacongtac()
        {
            return $this->macongtac;
        }
        public function setmacongtac($value)
        {
            $this->macongtac = $value;
        }

        public function getnhanvien_id()
        {
            return $this->nhanvien_id;
        }
        public function setnhanvien_id($value)
        {
            $this->nhanvien_id = $value;
        }

        public function getngaybd()
        {
            return $this->ngaybd;
        }
        public function setngaybd($value)
        {
            $this->ngaybd = $value;
        }

        public function getngaykt()
        {
            return $this->ngaykt;
        }
        public function setngaykt($value)
        {
            $this->ngaykt = $value;
        }

        public function getdiadiem()
        {
            return $this->diadiem;
        }
        public function setdiadiem($value)
        {
            $this->diadiem = $value;
        }

        public function getnhiemvu_congtac()
        {
            return $this->nhiemvu_congtac;
        }
        public function setnhiemvu_congtac($value)
        {
            $this->nhiemvu_congtac = $value;
        }

        public function getghichu()
        {
            return $this->ghichu;
        }
        public function setghichu($value)
        {
            $this->ghichu = $value;
        }

        // Lấy danh sách lịch công tác
        public function laycongtac()
        {
            $dbcon = DATABASE::connect();
            try {
                $sql = "SELECT * FROM congtac";
                $sql = "SELECT c.*, nv.hotennv FROM congtac c INNER JOIN nhanvien nv ON c.nhanvien_id = nv.id ORDER BY id DESC";
                $cmd = $dbcon->prepare($sql);
                $cmd->execute();
                $result = $cmd->fetchAll();
                return $result;
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn: $error_message</p>";
                exit();
            }
        }

        public function laycongtactheonhanvien($nhanvien_id)
        {
            $dbcon = DATABASE::connect();
            try {
                $sql = "SELECT * FROM congtac WHERE nhanvien_id = :nhanvien_id";
                $cmd = $dbcon->prepare($sql);
                $cmd->bindValue(":nhanvien_id", $nhanvien_id, PDO::PARAM_INT);
                $cmd->execute();
                $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                error_log("Lỗi truy vấn: " . $e->getMessage());
                return null;
            }
        }

        public function laycongtactheoid($id)
        {
            $dbcon = DATABASE::connect();
            try {
                $sql = "SELECT * FROM congtac WHERE id=:id";
                $cmd = $dbcon->prepare($sql);
                $cmd->bindValue(":id", $id);
                $cmd->execute();
                $result = $cmd->fetch();
                return $result;
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn: $error_message</p>";
                exit();
            }
        }

        // Thêm mới
        public function themcongtac($ct)
        {
            $dbcon = DATABASE::connect();
            try {
                $currentRowCount = $this->laySoLuongBanGhiHienTai();

                if ($ct->getngaybd() > $ct->getngaykt()) {
                    return false;
                }

                $sql = "INSERT INTO congtac(macongtac, nhanvien_id, ngaybd, ngaykt, diadiem, nhiemvu_congtac, ghichu) 
                        VALUES(:macongtac, :nhanvien_id, :ngaybd, :ngaykt, :diadiem, :nhiemvu_congtac, :ghichu)";

                $cmd = $dbcon->prepare($sql);
                $cmd->bindValue(":macongtac", $ct->getmacongtac());
                $cmd->bindValue(":nhanvien_id", $ct->getnhanvien_id());
                $cmd->bindValue(":ngaybd", $ct->getngaybd());
                $cmd->bindValue(":ngaykt", $ct->getngaykt());
                $cmd->bindValue(":diadiem", $ct->getdiadiem());
                $cmd->bindValue(":nhiemvu_congtac", $ct->getnhiemvu_congtac());
                $cmd->bindValue(":ghichu", $ct->getghichu());

                $result = $cmd->execute();
                return $result;
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn: $error_message</p>";
                exit();
            }
        }

        private function laySoLuongBanGhiHienTai()
        {
            $dbcon = DATABASE::connect();
            $sql = "SELECT COUNT(*) AS count FROM congtac";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $row = $cmd->fetch(PDO::FETCH_ASSOC);
            return $row['count'];
        }

        // Xóa 
        public function xoacongtac($ct)
        {
            $dbcon = DATABASE::connect();
            try {
                $sql_delete = "DELETE FROM congtac WHERE id=:id";
                $cmd_delete = $dbcon->prepare($sql_delete);
                $cmd_delete->bindValue(":id", $ct->getid());
                $result = $cmd_delete->execute();

                return $result;
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn: $error_message</p>";
                exit();
            }
        }

        // Cập nhật 
        public function suacongtac($ct)
        {
            $dbcon = DATABASE::connect();
            try {
                $currentRowCount = $this->laySoLuongBanGhiHienTai();

                $sql = "UPDATE congtac SET macongtac=:macongtac,
                                                nhanvien_id=:nhanvien_id, 
                                                ngaybd=:ngaybd, 
                                                ngaykt=:ngaykt, 
                                                diadiem=:diadiem,
                                                nhiemvu_congtac=:nhiemvu_congtac,
                                                ghichu=:ghichu 
                                                WHERE id=:id";
                $cmd = $dbcon->prepare($sql);
                $cmd->bindValue(":macongtac", $ct->getmacongtac());
                $cmd->bindValue(":nhanvien_id", $ct->getnhanvien_id());
                $cmd->bindValue(":ngaybd", $ct->getngaybd());
                $cmd->bindValue(":ngaykt", $ct->getngaykt());
                $cmd->bindValue(":diadiem", $ct->getdiadiem());
                $cmd->bindValue(":nhiemvu_congtac", $ct->getnhiemvu_congtac());
                $cmd->bindValue(":ghichu", $ct->getghichu());
                $cmd->bindValue(":id", $ct->getid());

                $result = $cmd->execute();
                return $result;
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn: $error_message</p>";
                exit();
            }
        }

        public function timkiemnv($keyword)
        {
            $dbcon = DATABASE::connect();
            try {
                $sql = "SELECT * FROM nhanvien WHERE manv LIKE :keyword";
                $cmd = $dbcon->prepare($sql);
                $cmd->bindValue(":keyword", "{$keyword}%", PDO::PARAM_STR);
                $cmd->execute();
                $result = $cmd->fetchAll(PDO::FETCH_ASSOC);

                $filteredResult = array_filter($result, function ($item) use ($keyword) {
                    return stripos($item['manv'], $keyword) === 0;
                });

                return $filteredResult;
            } catch (PDOException $e) {
                return null;
            }
        }

        public static function demSoLuongcongtac()
        {
            $dbcon = DATABASE::connect();
            try {
                $sql = "SELECT COUNT(*) FROM congtac";
                $result = $dbcon->query($sql);
                return $result->fetchColumn();
            } catch (PDOException $e) {
                return 0;
            }
        }

        public function kiemTraNgay($ngaybd, $ngaykt)
        {
            return $ngaybd > $ngaykt;
        }
    }
    ?>