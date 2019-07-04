<?php
require_once('controllers/base_controller.php');
require_once('models/user.php');

class UsersController extends BaseController
{
    function __construct()
    {
        $this->folder = 'users';
    }
    
    public function signup(){
        
        if (isset($_POST['btn_signup'])) {
            $user_name = $_POST['user_name'];
            $user_pw = $_POST['user_pw'];
            $full_name = $_POST['full_name'];
            
            $status = "OK";
            
            if (
                empty($user_name) ||
                empty($user_pw) ||
                empty($full_name)
            ) {
                $status = "Empty field(s)";
            } else {
                //check user name exist
                $insert_ok = User::addUser($user_name, $user_pw, $full_name);
                // $isExist = User::isExist($user_name);
                if (!$insert_ok)
                    $status = "This username's already existed!";
                else
                    $status = "Inserted!";
            }

            $data = array("status" => $status);
            $this->render('signup', $data);
        } else {
            $data = array();
            $this->render('signup', $data);
        }
    }

    public function login(){
        if (isset($_POST['btn_login'])) {
            $user_name = $_POST['user_name_lgin'];
            $user_pw = $_POST['user_pw_lgin'];

            $status = "OK";

            if (
                empty($user_name) ||
                empty($user_pw)
            ) {
                $status = "Empty field(s)";
            } else {
                $found = User::foundUser($user_name, $user_pw);
                if($found){
                    $status = "OK";
                    session_start();
                    $_SESSION['user_name'] = $user_name;
                    header("Location: index.php?controller=pages&action=home");
                }
                else
                    $status = "User not found";
            }

            $data = array("status" => $status);
            $this->render('login', $data);

        } else {
            $data = array();
            $this->render('login', $data);
        }
    }

    public function logout(){
        session_start();
        unset($_SESSION['user_name']);
        header("Location: index.php?controller=users&action=login");
    }
}
