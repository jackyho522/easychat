<?php
class Formerror extends Controller
{
    public function __construct()
    {
        $this->errorsModel = $this->model('Formerrors');
    }

    public function checkerror($data)
    {    /* https://www.php.net/manual/en/filter.filters.sanitize.php */
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        /* login data */
        if ($data['title'] === 'login') {
            $data = [
                'title' => 'login',  /* tell formerror what page is it */
                'username' => trim($_POST['username'], " "),
                'password' => trim($_POST['password'], " "),
                'usernameError' => '',
                'passwordError' => ''
            ];
            $data = array_replace($data, $data, $this->errorsModel->loginerror($data));
            /* register data */
        } else if ($data['title'] === 'register') {
            $data = [
                'title' => 'register', /* tell formerror what page is it */
                'firstname' => trim($_POST['firstname'], " "),
                'lastname' => trim($_POST['lastname'], " "),
                'gender' => trim($_POST['gender'], " "),
                'email' => trim($_POST['email'], " "),
                'nickname' => trim($_POST['nickname'], " "),
                'username' => trim($_POST['username'], " "),
                'password' => trim($_POST['password'], " "),
                'confirmpassword' => trim($_POST['confirmpassword'], " "),
                'confirm' => trim($_POST['confirm'], " "),
                'nameError' => '',
                'emailError' => '',
                'nicknameError' => '',
                'usernameError' => '',
                'passwordError' => '',
                'confirmpasswordError' => '',
                'buttonError' => '',
                'confirmError' => '',
                'checkError' => true
            ];
            $data = array_replace($data, $data, $this->errorsModel->register_error($data));
        } else if ($data['title'] === 'editprofile') {
            $data = [
                'title' => 'editprofile', /* tell formerror what page is it */
                'file' => basename($_FILES["uploadfile"]["name"]),
                'tempname' => $_FILES["uploadfile"]["tmp_name"],
                'firstname' => trim($_POST['firstname'], " "),
                'lastname' => trim($_POST['lastname'], " "),
                'email' => trim($_POST['email'], " "),
                'nickname' => trim($_POST['nickname'], " "),
                'age' => trim($_POST['age'], " "),
                'description' => trim($_POST['description'], " "),
                'username' => trim($_POST['username'], " "),
                'password' => trim($_POST['password'], " "),
                'confirmpassword' => trim($_POST['confirmpassword'], " "),
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
            $data = array_replace($data, $data, $this->errorsModel->profile_error($data));
        } 

        return $data;
    }

    public function checkerrorempty($data)
    {
        if ($data['title'] === "login") {
            return (empty($data['usernameError']) && empty($data['passwordError']));
        } else if ($data['title'] === "editprofile") {
            /* Users enter nth except correct username and password */
            /* Update form allow users enter empty value ,therefore a warning is shown that if there is nth to update */
            if (empty($data['tempname']) && empty($data['firstname']) && empty($data['lastname']) && empty($data['email']) && empty($data['nickname']) && empty($data['age']) && empty($data['description'])) {
                return false;
            }
            return (empty($data['fileError']) && empty($data['emailError']) && empty($data['nicknameError']) && empty($data['ageError']) && empty($data['descriptionError']) && empty($data['usernameError']) && empty($data['passwordError']) && empty($data['confirmpasswordError']));
        } else if ($data['title'] === 'register'){
            return (empty($data['nameError']) && empty($data['nicknameError']) && empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmpasswordError']) && empty($data['buttonError']) && empty($data['confirmError']));
        } 
    }
}
