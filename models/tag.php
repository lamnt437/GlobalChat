<?php

require_once('/opt/lampp/htdocs/mvc/chat/template/models/hashtag.php');

class Tag {
    public static function findAll() {
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
        $sql = "select * from hashtag_tb";  
        $stmt = $pdo->prepare($sql);  
        $stmt->execute();
        $hashtags = array();

        while (($result = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            $hashtag = new Hashtag($result['hashtag_id'], $result['hashtag_name']);

            array_push($hashtags, $hashtag);
        }

        return $hashtags;
    }

    public static function findNameById($hashtag_id) {
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
        // find hashtag name by id
        $sql = "select * from hashtag_tb where hashtag_id = :hashtag_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":hashtag_id", $hashtag_id, PDO::PARAM_INT);
        $stmt->execute();

        $hashtag_name = "unknown";
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result !== false){
            $hashtag_name = $result['hashtag_name'];
        }
        
        return $hashtag_name;
    }

    public static function findIdByName($hashtag_name){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
        // get hashtag_id
        $hashtag_name = strtoupper($hashtag_name);

        $sql = "SELECT hashtag_id FROM hashtag_tb WHERE hashtag_name = :hashtag_name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hashtag_name', $hashtag_name, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashtag_id = $result['hashtag_id'];

        return $hashtag_id;
    }

    public static function findByMessageId($message_id){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
        // get all hashtags associated with current message
        $sql = "select * from chat_tb natural join tag_tb natural join hashtag_tb where tag_tb.message_id = :message_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);
        $stmt->execute();
        $hashtag_names = array();

        while (($result = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            $hashtag_name = $result['hashtag_name'];
            array_push($hashtag_names, $hashtag_name);
        }

        return $hashtag_names;
    }

    public static function addHashtag($hashtag_name){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
        // insert hashtag
        // db will reject if hashtag is duplicated
        $hashtag_name = strtoupper($hashtag_name);
        $sql = "INSERT INTO hashtag_tb(hashtag_name) VALUES(:hashtag_name)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hashtag_name', $hashtag_name, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function addTagRel($message_id, $hashtag_id){
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
        // insert to tag_tb
        $sql = "INSERT INTO tag_tb(message_id, hashtag_id) VALUES(:message_id, :hashtag_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_STR);
        $stmt->bindParam(':hashtag_id', $hashtag_id, PDO::PARAM_STR);
        $stmt->execute();
    }
}

?>