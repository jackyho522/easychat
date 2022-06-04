<?php
class Formerrors extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function loginerror($data)
    {
        if (empty($data['username'])) {
            $data['usernameError'] = 'Username cannot be empty';
        }

        if (empty($data['password'])) {
            $data['passwordError'] = 'Password cannot be empty';
        }
        return $data;
    }

    public function register_error($data)
    {
        /* Check name */
        if (empty($data['firstname']) || empty($data['lastname'])) {
            $data['nameError'] = 'Name cannot be empty';
        } else if (!($this->userModel->checkname($data['firstname'], $data['lastname']))) {
            $data['nameError'] = 'Not a valid Name';
        }

        /* Check gender */
        if (empty($data['gender'])) {
            $data['buttonError'] = 'Please click the button';
        }

        /* Check email */
        if (empty($data['email'])) {
            $data['emailError'] = 'Email cannot be empty';
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $data['emailError'] = 'Email should be in correct format, such as foobar@foobar.com, foobar@foobar.net etc';
        } else {
            if ($this->userModel->checkregistered($data['email'])) {
                $data['emailError'] = 'This Email is already registered.';
            }
        }

        /* Check nickname */
        if (empty($data['nickname'])) {
            $data['nicknameError'] = 'Nickname cannot be empty';
        } else if (strlen($data['nickname']) <= 4 || strlen($data['nickname']) >= 31) {
            $data['nicknameError'] = 'Nickname should have at least 5 characters and at most 30 characters';
        } else if (!($this->userModel->checknickname($data['nickname']))) {
            $data['nicknameError'] = 'Nickname should start with a letter, at least one lowercase letter, one number and no special characters';
        } else if ($this->userModel->checkregistered_bynickname($data['nickname'])) {
            $data['nicknameError'] = 'The nickname is already registered';
        }

        /* Check username */
        if (empty($data['username'])) {
            $data['usernameError'] = 'Username cannot be empty';
        } else if (strlen($data['username']) <= 7 ||  strlen($data['username']) >= 31) {
            $data['usernameError'] = 'Username should have at least 8 characters and at most 30 characters';
        } else if (!($this->userModel->checkusername($data['username']))) {
            $data['usernameError'] = 'Username should start with a letter, at least one lowercase letter, one number and no special characters';
        } else if ($this->userModel->checkregistered_byusername($data['username'])) {
            $data['usernameError'] = 'This username is already registered';
        }

        /* Check password */
        if (empty($data['password'])) {
            $data['passwordError'] = 'Password cannot be empty';
        } else if (strlen($data['password']) <= 7) {
            $data['passwordError'] = 'Password should have at least 8 characters';
        } else if (!($this->userModel->checkstrongpassword($data['password']))) {
            $data['passwordError'] = 'Password should have at least one uppercase letter, one lowercase letter and one special character';
        }

        /* Check confirm password */
        if (empty($data['confirmpassword'])) {
            $data['confirmpasswordError'] = 'Please confirm your password';
        } else if ($data['password'] != $data['confirmpassword']) {
            $data['confirmpasswordError'] = 'Please try again! Password does not match';
        }

        /* Check final confirm */
        if ((int)$data['confirm'] == 0) {
            $data['confirmError'] = 'Please confirm that all data is correct';
        }

        return $data;
    }

    public function profile_error($data)
    {
        /* Check file */
        /* https://www.php.net/manual/en/function.finfo-file.php */
        if (empty($data['tempname'])) {
            $data['fileError'] = '';
        } else if (!($this->userModel->checkimage($data['tempname']))) {
            $data['fileError'] = 'The file is not valid. The file type should be an image and the file size should be between 1 - 3MB.';
        }

        /* Users are not required to enter all detail, therefore some inputs are allowed to empty */
        /* Check name */
        if (empty($data['firstname']) && empty($data['lastname'])) {
            $data['nameError'] = '';
        } else if (!($this->userModel->checkname($data['firstname'], $data['lastname']))) {
            $data['nameError'] = 'Not a valid Name';
        }

        /* Check email */
        if (empty($data['email'])) {
            $data['emailError'] = '';
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $data['emailError'] = 'Email should be in correct format, such as foobar@foobar.com, foobar@foobar.net etc';
        } else if ($this->userModel->checkregistered($data['email'])) {
            $data['emailError'] = 'This Email is already registered.';
        }

        /* Check nickname */
        if (empty($data['nickname'])) {
            $data['nicknameError'] = '';
        } else if (strlen($data['nickname']) <= 4 || strlen($data['nickname']) >= 31) {
            $data['nicknameError'] = 'Nickname should have at least 5 characters and at most 30 characters';
        } else if (!($this->userModel->checknickname($data['nickname']))) {
            $data['nicknameError'] = 'Nickname should start with a letter, at least one lowercase letter, one number and no special characters';
        } else if ($this->userModel->checkregistered_bynickname($data['nickname'])) {
            $data['nicknameError'] = 'The nickname is already registered';
        }

        /* Check birth */
        if (empty($data['age'])) {
            $data['ageError'] = '';
        } else if (!filter_var($data['age'], FILTER_VALIDATE_INT)) {
            $data['ageError'] = 'Age should be a number.';
        } else if ($data['age'] <= 0 || $data['age'] >= 120) {
            $data['ageError'] = 'Age is invalid.';
        }

        /* Check description */
        if (empty($data['description'])) {
            $data['descriptionError'] = '';
        } else if (strlen($data['description']) >= 31) {
            $data['descriptionError'] = 'Description should not exceed 30 characters.';
        } else if (!($this->userModel->checktext($data['description']))) {
            $data['descriptionError'] = "Description contains invalid characters. Only english, numbers and symbols like !,.'- is allowed in here.";
        }

        /* Check username */
        if (empty($data['username'])) {
            $data['usernameError'] = 'Username cannot be empty';
        } else if (strlen($data['username']) <= 7 ||  strlen($data['username']) >= 31) {
            $data['usernameError'] = 'Username should have at least 8 characters and at most 30 characters';
        } else if (!($this->userModel->checkusername($data['username']))) {
            $data['usernameError'] = 'Username should start with a letter, at least one lowercase letter, one number and no special characters';
        } else if (!($this->userModel->checkregistered_byusername($data['username']))) {
            $data['usernameError'] = 'This username does not exist.';
        }

        /* Check password */
        if (empty($data['password'])) {
            $data['passwordError'] = 'Password cannot be empty';
        } else if (strlen($data['password']) <= 7) {
            $data['passwordError'] = 'Password should have at least 8 characters';
        } else if (!($this->userModel->checkstrongpassword($data['password']))) {
            $data['passwordError'] = 'Password should have at least one uppercase letter, one lowercase letter and one special character';
        }

        /* Check confirm password */
        if (empty($data['confirmpassword'])) {
            $data['confirmpasswordError'] = 'Please confirm your password';
        } else if ($data['password'] != $data['confirmpassword']) {
            $data['confirmpasswordError'] = 'Please try again! Password does not match';
        }
        return $data;
    }
}
