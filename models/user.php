<?php

class User extends Db
{

    public function getAccount($username, $password, $role)
    {
        $stmt = self::$connection->prepare("SELECT * FROM `user` WHERE `username` = ?  AND `password` = ? AND `role` = ?");
        $stmt->bind_param("sss", $username, $password, $role);
        if ($stmt->execute()) {
            return $stmt->get_result()->fetch_assoc();
        }

        return false;
    }




    public function addAccount($username, $password, $role)
    {
        // Kiểm tra xem username đã tồn tại chưa
        $stmt = self::$connection->prepare("SELECT * FROM `user` WHERE `username` = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "Username already exists"; // Trả về thông báo nếu username đã tồn tại
        }

        // Thực hiện thêm tài khoản mới
        $stmt = self::$connection->prepare("INSERT INTO `user` (`username`, `password`, `role`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);

        if ($stmt->execute()) {
            return "Account created successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}
