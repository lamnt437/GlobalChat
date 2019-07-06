<?php

class Hashtag {
    public $hashtag_id;
    public $hashtag_name;

    public function __construct($hashtag_id, $hashtag_name){
        $this->hashtag_id = $hashtag_id;
        $this->hashtag_name = $hashtag_name;
    }
}
?>