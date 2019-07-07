<?php
require_once('controllers/base_controller.php');
require_once('models/chat.php');
require_once('models/tag.php');


class PagesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'pages';
  }

  public function home()
  {
    session_start();

    if(!isset($_SESSION['user_name']))
      header('Location: index.php?controller=users&action=login');

    if (isset($_POST['message'])) {
      // check for empty field
      $message_content = $_POST['message'];
      $hashtag_input = $_POST['hashtag_name'];
      if (empty($message_content)) {
        $status = "Empty message";
      }
      // insert
      else{
        if(empty($hashtag_input))
          $hashtag_input = "general";

        $user_id = $_SESSION['user_id'];
        $mess_time = date("Y-m-d h:i:sa");

        CHAT::addMessage($user_id, $message_content, $mess_time, $hashtag_input);
        
        $status = "Message added";
      }
    }

    $messages = Chat::findAll();
    $hashtags = Tag::findAll();

    $data = array(
      'messages' => $messages,
      'hashtags' => $hashtags,
      // 'status' => $status
    );
    $this->render('home', $data);

    // return $data;  // for test controller
  }

  public function group()
  {
    session_start();

    if(!isset($_SESSION['user_name']))
      header('Location: index.php?controller=users&action=login');

    if(!isset($_GET['hashtag_id']))
      header('Location: index.php?controller=pages&action=home');

    $hashtag_id = $_GET['hashtag_id'];

    $messages = Chat::findByHashtagId($hashtag_id);
    $hashtag_name = Tag::findNameById($hashtag_id);

    $data = array(
      'messages' => $messages,
      'hashtag_name' => $hashtag_name,
      'status' => $status
    );

    $this->render('group', $data);
  }

  public function error()
  {
    $this->render('error');
  }
}
