<?php
class User{
    public static function isExist($user_name){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");

        $sql = 'select * from user_tb where user_name = :user_name';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->execute();
        $status = $stmt->rowCount();

        if($status) // record exists
            return true;
        return false;

    }

    public static function addUser($user_name, $user_pw, $full_name){
        $db = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
        $db->exec("SET NAMES 'utf8'");

        // check for empty fields
        if (
            empty($user_name) ||
            empty($user_pw) ||
            empty($full_name)
        ) {
            return false;
        }
        
        // check if user already existed
        if(self::isExist($user_name))
            return false;

        // ok then insert
        // $req = $db->query("INSERT INTO user_tb (user_name, user_pw, full_name) VALUES(\'$user_name\', \'$user_pw\', \'$full_name\'");
        $sql = "INSERT INTO user_tb(user_name, user_pw, full_name) VALUES(:user_name, :user_pw, :full_name)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->bindParam(':user_pw', $user_pw, PDO::PARAM_STR);
        $stmt->bindParam(':full_name', $full_name, PDO::PARAM_STR);

        $stmt->execute();
        
        return true;
    }

    public static function foundUser($user_name, $user_pw){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
        $pdo->exec("SET NAMES 'utf8'");

        $sql = 'select * from user_tb where user_name = :user_name and user_pw = :user_pw';
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->bindValue(':user_pw', $user_pw, PDO::PARAM_STR);

        $stmt->execute();
        $status = $stmt->rowCount();

        return $status;
    }

    public static function findByUsername($user_name){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
        $pdo->exec("SET NAMES 'utf8'");

        $sql = 'select * from user_tb where user_name = :user_name';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result !== false)
            return $result;
        else
            return null;
    }
}
?>