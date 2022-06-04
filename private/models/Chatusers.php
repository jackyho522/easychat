<?php

class Chatusers
{
    private $db;	
    public function __construct()
    {
        $this->db = new database;
    }

    function findusersbytoken($token)
	{
        $this->db->query('SELECT * FROM users WHERE user_token = :token');
        $this->db->bind(':token', $token);
        $row = $this->db->single();
        return $row;
	}

    function getuserstoken($uuid)
	{
        $this->db->query('SELECT * FROM users WHERE uuid = :uuid');
        $this->db->bind(':uuid', $uuid);
        $row = $this->db->single();
        return $row['user_token'];
	}

}
