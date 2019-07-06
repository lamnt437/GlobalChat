<?php
class Message {
    public $message_id;
    public $user_name;
    public $full_name;
    public $message;
    public $mess_time; 
    public $hashtag;

    public function __construct($message_id, $user_name,
    $full_name, $message, $mess_time){
        $this->message_id = $message_id;
        $this->user_name = $user_name;
        $this->full_name = $full_name;
        $this->message = $message;
        $this->mess_time = $mess_time;
        $this->hashtag = $hashtag;
    }
}
?>