<?php
require_once('/opt/lampp/htdocs/mvc/chat/template/models/message.php');

class Chat {
    public static function findAll(){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
        
        $sql = "select * from user_tb natural join chat_tb natural join tag_tb natural join hashtag_tb";        
        $stmt = $pdo->prepare($sql);        
        $stmt->execute();        
        $messages = array();

        while (($result = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            $message = new Message($result['message_id'], $result['user_name'],
            $result['full_name'], $result['message'], $result['mess_time'], $result['hashtag_name']);

            array_push($messages, $message);
        }

        return $messages;
    }

    public static function findByHashtag($hashtag_name){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");

        $sql = "SELECT *
        FROM user_tb, chat_tb, tag_tb, hashtag_tb
        WHERE user_tb.user_id = chat_tb.user_id
        AND chat_tb.message_id = tag_tb.message_id
        AND tag_tb.hashtag_id = hashtag_tb.hashtag_id
        AND hashtag_name = :hashtag_name";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hashtag_name', $hashtag_name, PDO::PARAM_STR);
        $stmt->execute();        
        $messages = array();

        while (($result = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            $message = new Message($result['message_id'], $result['user_name'],
            $result['full_name'], $result['message'], $result['mess_time'], $result['hashtag_name']);

            array_push($messages, $message);
        }

        return $messages;
    }

    public static function findByHashtagId($hashtag_id){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");

        $sql = "SELECT *
        FROM user_tb, chat_tb, tag_tb, hashtag_tb
        WHERE user_tb.user_id = chat_tb.user_id
        AND chat_tb.message_id = tag_tb.message_id
        AND tag_tb.hashtag_id = hashtag_tb.hashtag_id
        AND hashtag_tb.hashtag_id = :hashtag_id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hashtag_id', $hashtag_id, PDO::PARAM_INT);
        $stmt->execute();        
        $messages = array();

        while (($result = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            $message = new Message($result['message_id'], $result['user_name'],
            $result['full_name'], $result['message'], $result['mess_time'], $result['hashtag_name']);

            array_push($messages, $message);
        }

        return $messages;
    }

    public static function addMessage($user_id, $message, $mess_time, $hashtag_name){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");

        // insert message
        $sql = "INSERT INTO chat_tb(user_id, message, mess_time) VALUES(:user_id, :message, :mess_time)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $stmt->bindParam(':mess_time', $mess_time, PDO::PARAM_STR);
        $stmt->execute();

        // get message_id
        $sql = "SELECT message_id FROM chat_tb WHERE mess_time = :mess_time";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mess_time', $mess_time, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $message_id = $result['message_id'];
        
        // insert hashtag
        // db will reject if hashtag is duplicated
        $sql = "INSERT INTO hashtag_tb(hashtag_name) VALUES(:hashtag_name)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hashtag_name', $hashtag_name, PDO::PARAM_STR);
        $stmt->execute();
        
        // get hashtag_id
        $sql = "SELECT hashtag_id FROM hashtag_tb WHERE hashtag_name = :hashtag_name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hashtag_name', $hashtag_name, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashtag_id = $result['hashtag_id'];

        // insert to tag_tb
        $sql = "INSERT INTO tag_tb(message_id, hashtag_id) VALUES(:message_id, :hashtag_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_STR);
        $stmt->bindParam(':hashtag_id', $hashtag_id, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>