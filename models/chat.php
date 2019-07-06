<?php
require_once('models/message.php');
class Chat {
    public static function findAll(){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
        
        $sql = "select * from chat_tb natural join user_tb";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute();
        
        $messages = array();

        while (($result = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            // print_r($result);

            $message = new Message($result['message_id'], $result['user_name'],
            $result['full_name'], $result['message'], $result['mess_time']);

            array_push($messages, $message);
        }

        return $messages;
    }

    public static function addMessage($user_id, $message, $mess_time){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
        
        // $sql = "insert into chat_tb(user_id, message, time) values(:user_id, :message, :time)";

        // $stmt = $pdo->prepare($sql);
        // $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        // $stmt->bindValue(":message", $message, PDO::PARAM_STR);
        // $stmt->bindValue(":mess_time", $mess_time, PDO::PARAM_STR);

        // $time = null;

        $sql = "INSERT INTO chat_tb(user_id, message, mess_time) VALUES(:user_id, :message, :mess_time)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $stmt->bindParam(':mess_time', $mess_time, PDO::PARAM_STR);

        $stmt->execute();
        
    }
}
?>