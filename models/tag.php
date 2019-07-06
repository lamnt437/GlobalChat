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
}

?>