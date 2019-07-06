<?php
    include('/opt/lampp/htdocs/mvc/chat/template/models/chat.php');

    $messages = Chat::findAll();
    print_r($messages);
?>