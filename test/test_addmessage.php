<?php
    include('/opt/lampp/htdocs/mvc/chat/template/models/chat.php');

    $mess_time = date("Y-m-d h:i:sa");
    Chat::addMessage(6, "I'm fine, thank you and you?", $mess_time, "greeting");
?>