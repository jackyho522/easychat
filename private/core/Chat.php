<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    /* private $db_host = 'localhost'; */
    private $db_host = '127.0.0.1';
    private $db_user = 'root';
    private $db_pass = '';
    private $db_name = 'chat_db';
    private $statement;
    private $error;
    private $db_handler;
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->connect = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->db_handler = new PDO($this->connect, $this->db_user, $this->db_pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        echo "Server Started\n";
        echo "New connection!\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    { /*this function will receive data from the chat form */
        /* $msg = users messages */
        echo "Sending message to other connection\n";
        $data = json_decode($msg, true);
        if ($data['command'] === 'public') {

            $data['status_type'] = 'Online';
            $data['dt'] = date("Y-m-d h:i:s");
            if ($this->savemessage($data)) {
                echo "Saved message to DB\n";
            } else {
                echo "Failed to save message\n";
            }    
            foreach ($this->clients as $client) {
                if ($from == $client) {
                    $data['from'] = 'Me';
                } else {
                    $data['from'] = $this->senderdata($data['uuid'])['username'];
                }

                $client->send(json_encode($data));
            }
        } else if ($data['command'] === 'private'){
            $data['status_type'] = 'Online';
            $data['dt'] = date("Y-m-d h:i:s");
            $data['sender'] = $this->senderdata($data['from_uuid'])['username'];
            $data['receiver'] = $this->senderdata($data['to_uuid'])['username'];
            if ($this->saveprivatemessage($data)) {
                echo "Saved message to Private DB\n";
            } else {
                echo "Failed to save message\n";
            } 
            foreach ($this->clients as $client) {
                if ($from == $client) {
                    $data['from'] = 'Me';
                } else {
                    $data['from'] = $this->senderdata($data['from_uuid'])['username'];
                }
                $client->send(json_encode($data));
            }

        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "A user has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function savemessage($data)
    {
        /* fixed time format problem */
        $query = "INSERT INTO chatrooms (id, uuid, msg, created_on) VALUES (default, :uuid, :msg, :created_on)";
        $this->query($query);
        $date_field = date($data['dt']);
        $this->bind(':uuid', $data['uuid']);
        $this->bind(':msg', $data['msg']);
        $this->bind(':created_on', $date_field);
        return ($this->execute() > 0);
    }

    public function saveprivatemessage($data)
    {
        /* fixed uuid input*/
        $query = "INSERT INTO privatemessage (id, sender, receiver, msg, created_on) VALUES (default, :sender, :receiver, :msg, :created_on)";
        $this->query($query);
        $date_field = date($data['dt']);
        $this->bind(':sender',  $data['sender']);
        $this->bind(':receiver',  $data['receiver']); 
        $this->bind(':msg', $data['msg']);
        $this->bind(':created_on', $date_field);
        return ($this->execute() > 0);
    }

    public function senderdata($uuid)
    {
        /* fixed time format problem */
        $query = "SELECT * FROM users WHERE uuid = :uuid";
        $this->query($query);
        $this->bind(':uuid', $uuid);
        return $this->single();
    }

    /* functions from database since they are under different class */
    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function column()
    {
        $this->execute();
        return $this->statement->fetchColumn();
    }

    public function query($sql)
    {
        $this->statement = $this->db_handler->prepare($sql);
    }

    public function execute()
    {
        return $this->statement->execute();
    }

    public function bind($param, $value, $type = null)
    {
        switch (is_null($type)) {
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($param, $value, $type);
    }
}
