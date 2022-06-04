<?php
class Register extends Controller
{
	public function __construct()
	{
		$this->userModel = $this->model('User');
		$this->errorModel = $this->model('Formerror');
	}

	public function index()
	{
		$data = [
			'title' => 'register', /* tell formerror what page is it */
			'firstname' => '',
			'lastname' => '',
			'email' => '',
			'nickname' => '',
			'username' => '',
			'password' => '',
			'confirmpassword' => '',
			'gender' => '',
			'confirm' => '',
			'nameError' => '',
			'nicknameError' => '',
			'usernameError' => '',
			'emailError' => '',
			'passwordError' => '',
			'confirmpasswordError' => '',
			'buttonError' => '',
			'confirmError' => ''
		];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			/* check error as a function */
			$data = $this->errorModel->checkerror($data);
			/* check no error as a function */
			if ($this->errorModel->checkerrorempty($data)) {
				$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
				if ($this->userModel->register($data)) {
					redirect('login');
				} else {
					die('Register Failed');
				}
			}
		}

		$this->view('register', $data);
	}

}
