<?php

class Chatinfo
{
    private $db;	
    public function __construct()
    {
        $this->db = new database;
    }
	
    function chatdata()
    {
        $query = "SELECT * FROM chatrooms INNER JOIN users ON users.uuid = chatrooms.uuid ORDER BY chatrooms.id, chatrooms.uuid ASC";
        $this->db->query($query);
        $row = $this->db->allresult();
        return $row;
    }

    function privatechatdata($sender,$receiver)
    {
        $query = "SELECT * FROM privatemessage INNER JOIN users ON users.username = privatemessage.sender WHERE (sender = :sender and receiver = :receiver) or (sender = :receiver and receiver = :sender) ORDER BY privatemessage.id, privatemessage.created_on ASC";
        $this->db->query($query);
        $this->db->bind(':sender',$sender);
        $this->db->bind(':receiver',$receiver);
        $row = $this->db->allresult();
        return $row;
    }
}
