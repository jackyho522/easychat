<?php

use Hackzilla\PasswordGenerator\Generator\RequirementPasswordGenerator;
use Ramsey\Uuid\Uuid;

class User
{
    private $db;
    public function __construct()
    {
        $this->db = new database;
    }

    
    public function randpass()
    {
        $generator = new RequirementPasswordGenerator();
        $generator
        ->setLength(16)
        ->setOptionValue(RequirementPasswordGenerator::OPTION_UPPER_CASE, true)
        ->setOptionValue(RequirementPasswordGenerator::OPTION_LOWER_CASE, true)
        ->setOptionValue(RequirementPasswordGenerator::OPTION_NUMBERS, true)
        ->setOptionValue(RequirementPasswordGenerator::OPTION_SYMBOLS, true)
        ->setMinimumCount(RequirementPasswordGenerator::OPTION_UPPER_CASE, 2)
        ->setMinimumCount(RequirementPasswordGenerator::OPTION_LOWER_CASE, 2)
        ->setMinimumCount(RequirementPasswordGenerator::OPTION_NUMBERS, 2)
        ->setMinimumCount(RequirementPasswordGenerator::OPTION_SYMBOLS, 2)
        ->setMaximumCount(RequirementPasswordGenerator::OPTION_UPPER_CASE, 8)
        ->setMaximumCount(RequirementPasswordGenerator::OPTION_LOWER_CASE, 8)
        ->setMaximumCount(RequirementPasswordGenerator::OPTION_NUMBERS, 8)
        ->setMaximumCount(RequirementPasswordGenerator::OPTION_SYMBOLS, 8)
        ;
        $password = $generator->generatePassword();
        return $password;
    }

    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        $row = $this->db->single();
        /* verify bcrypt */
        if (isset($row['password'])) {
            $hashed = $row['password'];
            if (password_verify($password, $hashed)) {
                $id = $row['id'] . ',' . $row['uuid'];
                $_SESSION['user_data'][$row['uuid']] = [
                    'id'    =>  $id,
                    'name'  =>  $row['username'],
                    'profile'  => $row['filename'],
                    'token' => $this->randpass()
                ];
                $_SESSION['last_activity'] = time();
                return true;
            }
        } else {
            return false;
        }
    }

    public function checkactivity()
    {
        /* expire and return false if users login > 30 mins */
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            $this->logout();
            return false;
        } else {
            return true;
        }
    }

    public function checklogin()
    {
        $this->db->query('SELECT * FROM users WHERE uuid = :uuid');
        $this->db->bind(':uuid', $this->getID());
        $row = $this->db->single();
        if (isset($_SESSION['user_data'])) {
            $hashed = $row['user_token'];
            if (password_verify($this->getToken(), $hashed)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function logout()
    {
        $this->status(0,$this->getUsername());
        session_unset();     // unset $_SESSION variable 
        session_destroy();   // destroy session data in storage
        $_SESSION['LAST_ACTIVITY'] = time();
    }

    public function status($number, $username){
        if ($number != 0){
            $token = password_hash($this->getToken(), PASSWORD_BCRYPT);
        } else {
            $token = 0;
        }
        $this->db->query('UPDATE users SET status = :status, user_token = :user_token WHERE username = :username');
        $this->db->bind(':status', $number);
        $this->db->bind(':username', $username);
        $this->db->bind(':user_token', $token);
        return ($this->db->execute() > 0);
    }

    public function register($data)
    {
        $uuid = Uuid::uuid4();
        $this->db->query('INSERT INTO users (id, uuid, firstname, lastname, gender, email, username, password, nickname, status, user_token) VALUES(DEFAULT, :uuid, :firstname, :lastname, :gender, :email, :username, :password, :nickname, DEFAULT, DEFAULT)');
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':nickname', $data['nickname']);
        $this->db->bind(':uuid', $uuid);
        return ($this->db->execute() > 0); /*if larger than zero, return true */
    }

    public function update($username, $password, $data)
    {
        /* need correct password to update profile successfully */
        $sql = '';
        for ($i = 1; $i < 9; $i++) {
            $dbfields[] = array_keys($data)[$i];
        }
        $row = $this->findusers($this->getID());
        if (password_verify($password, $row['password'])) {
            foreach ($dbfields as $name) {
                if (!empty($data[$name])) {
                    if ($name === 'file') {
                        $filename = $data['file'];
                        $tempname = $data['tempname'];
                        $uploadfolder =  './assets/usericon/' . $filename;
                        $sql .= "filename = " . "'" . $filename . "'" . ", ";
                        if (move_uploaded_file($tempname, $uploadfolder)) {
                            $_SESSION['user_data'][$this->getID()]['profile'] = $filename;
                        } else {
                            return false;
                        }
                    } else if ($name === 'tempname') {
                        $sql .= "";
                    } else {
                        $sql .= "$name = '{$data[$name]}', ";
                    }
                }
            }
            $sql = rtrim($sql, ', ');
            /* trim the end space and comma */
            $updatedsql = 'UPDATE users SET ' . $sql . ' WHERE username = :username';
            $this->db->query($updatedsql);
            $this->db->bind(':username', $username);
            if ($this->db->execute() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkregistered($email)
    {
        $this->db->query('SELECT COUNT(*) FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        if ($this->db->column() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkregistered_byusername($username)
    {
        $this->db->query('SELECT COUNT(*) FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        if ($this->db->column() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkregistered_bynickname($nickname)
    {
        $this->db->query('SELECT COUNT(*) FROM users WHERE nickname = :nickname');
        $this->db->bind(':nickname', $nickname);
        if ($this->db->column() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkstrongpassword($password)
    {
        return (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()-_+=~\/\?\[\]{}+])[A-Za-z\d!@#$%^&*()-_+=~\/\?\[\]{}+]{0,}$/', $password));
        /*otp is disabled now 
        if ($password['title'] === 'otp') {
            return (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()-_+=~\/\?\[\]{}+])[A-Za-z\d!@#$%^&*()-_+=~\/\?\[\]{}+]{16}$/', $password));
        } 
        */
    }

    public function checkusername($username)
    {
        return (preg_match('/^[a-zA-Z](?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{0,}$/', $username));
    }

    public function checkname($firstname, $lastname)
    {
        return (preg_match('/^(?=.*[a-zA-Z])[a-zA-Z ,.-]{0,}$/i', $firstname) && preg_match('/^(?=.*[a-zA-Z])[a-zA-Z ,.-]{0,}$/i', $lastname));
        /* not case sensitive regex */
    }

    public function checknickname($nickname)
    {
        return (preg_match("/^[a-zA-Z](?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{0,}$/", $nickname));
        /* not case sensitive regex */
    }

    public function checktext($text)
    {
        $illegal = "abcdefghijklmnopqrstuvwxyzABDEFGHIJKLMNOPQRSTUVWXYZ`~!@#$%^&*()_-+={}[]\|;:'<>,./?";
        $check = strpbrk($illegal, $text);
        if ($check === false) {
            return false;
        } else {
            return true;
        }
    }

    public function checkimage($file)
    {
        /* https://www.php.net/manual/en/function.finfo-open.php */
        /* only receive image type file */
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($finfo, $file);
        $filesize = filesize($file);
        finfo_close($finfo);
        if (substr($filetype, 0, 5) === 'image') {
            return true;
        } else {
            return false;
        }
        if ($filesize === 0) {
            return false;
        } else if ($filesize > 3145728) {
            return false;
        }
        return false;
    }

    public function getID()
    {
        foreach ($_SESSION['user_data'] as $key => $value) {
            $user_id = $value['id'];
        }
        return explode(',', $user_id)[1];
    }

    public function getUsername()
    {
        foreach ($_SESSION['user_data'] as $key => $value) {
            $username = $value['name'];
        }
        return $username;
    }

    public function getToken()
    {
        foreach ($_SESSION['user_data'] as $key => $value) {
            $token = $value['token'];
        }
        return $token;
    }

    public function findusers($uuid)
    {
        $this->db->query('SELECT * FROM users WHERE uuid = :uuid');
        $this->db->bind(':uuid', $uuid);
        $row = $this->db->single();
        return $row;
    }

    public function findusersbynickname($nickname)
    {
        $this->db->query('SELECT * FROM users WHERE nickname = :nickname');
        $this->db->bind(':nickname', $nickname);
        $row = $this->db->single();
        return $row;
    }

    public function findallusers()
    {
        $this->db->query('SELECT * FROM users ORDER BY id, uuid');
        $row = $this->db->allresult();
        return $row;
    }

    public function totalusers()
    {
        $this->db->query('SELECT COUNT(*) FROM users');
        $row = $this->db->column();
        return $row;
    }
}
