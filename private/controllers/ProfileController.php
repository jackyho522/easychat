<?php

class Profile extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if ($this->userModel->checkactivity() && $this->userModel->checklogin()) {
            if (isset($_GET['nickname'])) {
                $data = $this->userModel->findusersbynickname($_GET['nickname']);
                $this->view('profile', $data);
            } else {
                $data = $this->userModel->findusers($this->userModel->getID());
                $this->view('profile', $data);
            }
        } else {
            redirect('WrongPage');
        }
    }
}
