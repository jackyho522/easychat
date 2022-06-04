<?php

class Login extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->errorModel = $this->model('Formerror');
    }

    public function index()
    {
        $data = [
            'title' => 'login', /* tell formerror what page is it */
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            /* check error as a function */
            $data = $this->errorModel->checkerror($data);
            /* check no error as a function */
            if ($this->errorModel->checkerrorempty($data)) {
                /* verify bcrypt hash */
                $logging = $this->userModel->login($data['username'], $data['password']);
                if ($logging) {
                    $this->userModel->status(1,$data['username']); /* update login status and token */
                    redirect('home');
                } else {
                    $data['passwordError'] = 'Username or password is not correct. Please try again.';
                    $this->view('login', $data);
                }
            }
        } else {
            $data = [
                'title' => 'login',
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('login', $data);
    }

    public function leave()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'leave') {
            $this->userModel->logout();
            echo json_encode(['status' => 1]);
        }
    }
}
