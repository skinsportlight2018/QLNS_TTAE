<?php
class DATABASE
{
    private static $dns = "mysql:host=localhost;dbname=qlns_ttae;port=3306";
    private static $username = "root";
    private static $password = "";
    private static $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    );
    private static $db;

    private function __construct()
    {
    }

    public static function connect()
    {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(
                    self::$dns,
                    self::$username,
                    self::$password,
                    self::$options
                );
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi kết nối: $error_message</p>";
                exit();
            }
        }
        return self::$db;
    }

    public static function close()
    {
        self::$db = null;
    }

    public static function execute_query($sql, $option = array())
    {
        self::connect();
        if (self::$db != null) {
            try {
                $cmd = self::$db->prepare($sql);
                if (count($option) > 0) {
                    for ($i = 0; $i < count($option); $i++) {
                        $cmd->bindParam($i + 1, $option[$i]);
                    }
                }
                $cmd->execute();
                return $cmd; // Trả về đối tượng PDOStatement
            } catch (PDOException $ex) {
                // Thay thế bằng cách in ra lỗi hoặc xử lý lỗi một cách thích hợp
                echo "Lỗi: " . $ex->getMessage();
                return null; // Trả về null trong trường hợp lỗi
            }
        } else {
            // Thay thế bằng cách in ra lỗi hoặc xử lý lỗi một cách thích hợp
            echo "Lỗi kết nối cơ sở dữ liệu";
            return null; // Trả về null trong trường hợp lỗi
        }
    }
}
