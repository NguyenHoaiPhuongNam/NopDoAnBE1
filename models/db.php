<!--db.php-->
<?php
class Db {
    public static $connection = null;
    
    public function __construct() {
        if (!self::$connection) {
            self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, PORT);
            self::$connection->set_charset(DB_CHARSET);

            // Kiểm tra kết nối
            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }

        
    }
}


?>
