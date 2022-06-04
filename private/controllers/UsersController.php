<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if ($this->userModel->checkactivity() && $this->userModel->checklogin()) {
            $data = $this->userModel->findallusers();
            array_push($data, $this->userModel->getUsername());
            $this->view('users', $data);
        } else {
            redirect("WrongPage");
        }
    }
}
