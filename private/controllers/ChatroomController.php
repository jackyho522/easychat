<?php

class Chatroom extends Controller
{
    private $token;
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->chatModel = $this->model('Chatinfo');
        $this->chatuserModel = $this->model('Chatusers');
    }

    function index()
    {
        if ($this->userModel->checkactivity() && $this->userModel->checklogin()) {
            $chat = $this->chatModel->chatdata();
            $this->view('chatroom', $chat);
        } else {
            redirect('WrongPage');
        }
    }

    public function private()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'private') {
            $this->token = $_POST['token'];
            if ($this->userModel->checkactivity() && $this->userModel->checklogin()) {
                $row = $this->chatuserModel->findusersbytoken($this->token);
                $_SESSION['private'][$this->userModel->getID()] = [
                    'from_id'    =>  $this->userModel->getID(),
                    'to_id'  =>  $row['uuid'],
                ];
                echo json_encode(['status' => 1]);
            } else {
                echo json_encode(['status' => 0]);
            }
        }
    }
}
