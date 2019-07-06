<?php
require_once('controllers/base_controller.php');
require_once('models/chat.php');


class PagesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'pages';
  }

  public function home()
  {
    session_start();

    if (isset($_POST['message'])) {
      // check for empty field
      $message_content = $_POST['message'];
      if (empty($message_content)) {
        $status = "Empty message";
      }
      // insert
      else{
        $user_id = $_SESSION['user_id'];
        $mess_time = date("Y-m-d h:i:sa");

        CHAT::addMessage($user_id, $message_content, $mess_time);
        
        $status = "Message added";
      }
    }

    $messages = Chat::findAll();

    $data = array(
      'messages' => $messages,
      'status' => $status
    );
    $this->render('home', $data);
  }

  public function error()
  {
    $this->render('error');
  }
}
