<?php
    require_once('/opt/lampp/htdocs/mvc/chat/template/models/tag.php');

    $hashtag_list = Tag::findByMessageId(28);
    print_r($hashtag_list);
?>