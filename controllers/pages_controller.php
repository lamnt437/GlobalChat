<?php
require_once('/opt/lampp/htdocs/mvc/chat/template/controllers/base_controller.php');
require_once('/opt/lampp/htdocs/mvc/chat/template/models/chat.php');
require_once('/opt/lampp/htdocs/mvc/chat/template/models/tag.php');


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
      $hashtag_name = $_POST['hashtag_name'];
      if (empty($message_content)) {
        $status = "Empty message";
      }
      // insert
      else{
        $user_id = $_SESSION['user_id'];
        $mess_time = date("Y-m-d h:i:sa");

        CHAT::addMessage($user_id, $message_content, $mess_time, $hashtag_name);
        
        $status = "Message added";
      }
    }

    $messages = Chat::findAll();
    $hashtags = Tag::findAll();

    $data = array(
      'messages' => $messages,
      'hashtags' => $hashtags,
      'status' => $status
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

    $data = array(
      'messages' => $messages,
      'status' => $status
    );

    $this->render('group', $data);
  }

  public function error()
  {
    $this->render('error');
  }
}
