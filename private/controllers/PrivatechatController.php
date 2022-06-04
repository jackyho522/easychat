<?php

class Privatechat extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->chatModel = $this->model('Chatinfo');
        $this->chatuserModel = $this->model('Chatusers');
    }

    function index()
    {
        if ($this->userModel->checkactivity() && $this->userModel->checklogin()) {
            $from_id = $_SESSION['private'][$this->userModel->getID()]['from_id'];
            $to_id = $_SESSION['private'][$this->userModel->getID()]['to_id'];
            $sender = $this->userModel->findusers($from_id);
            $receiver = $this->userModel->findusers($to_id);
            $chat = $this->chatModel->privatechatdata($sender['username'], $receiver['username']);
            $token = $this->chatuserModel->getuserstoken($to_id);
            $conndata = [
                'senderid' => $to_id,
                'token' => $token
            ];
            array_push($chat, $conndata);
            $this->view('privatechat', $chat);
        } else {
            redirect('WrongPage');
        }
    }
}
