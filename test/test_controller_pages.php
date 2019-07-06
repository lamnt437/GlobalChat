<?php
    require_once('/opt/lampp/htdocs/mvc/chat/template/controllers/pages_controller.php');

    $controller = new PagesController();

    $_POST['message'] = "Hello, World";
    $_POST['hashtag_name'] = "test";

    $data = $controller->home();

    $messages = $data['messages'];
    $hashtags = $data['hashtags'];

    foreach($messages as $message){
        print_r($message);
        echo '</br>';
    }

    foreach($hashtags as $hashtag){
        print_r($hashtag);
        echo '</br>';
    }
?>