<?php

class Editprofile extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->errorModel = $this->model('Formerror');
    }

    public function index()
    {
        $data = [
            'title' => 'editprofile', /* tell formerror what page is it */
            'file' => '',
            'tempname' => '',
            'firstname' => '',
			'lastname' => '',
			'email' => '',
            'nickname' => '',
            'age' => '',
            'description' => '',
            'username' => '',
			'password' => '',
			'confirmpassword' => '',
            'fileError' => '',
            'nameError' => '',
            'emailError' => '',
            'nicknameError' => '',
            'ageError' => '',
            'descriptionError' => '',
            'usernameError' => '',
            'passwordError' => '',
            'confirmpasswordError' => ''
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            /* check error as a function */
            $data = $this->errorModel->checkerror($data);
            /* check no error as a function */
            if ($this->errorModel->checkerrorempty($data)) {
                if ($this->userModel->update($data['username'], $data['password'], $data)) {  
                    redirect('profile');
                } else {
                    $data['passwordError'] = 'Username or password is not correct. Please try again.';
                    $this->view('editprofile', $data);
                }
            } 
        }
        
        if ($this->userModel->checkactivity() && $this->userModel->checklogin()){
            $this->view('editprofile', $data);
        } else {
            redirect('WrongPage');
        }
    }
}
