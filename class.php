<?php
class address {
    var $newAddr;
    var $host = "localhost";
    var $dbname = "addressbook";
    var $user = "root";
    var $pass = "";
    public $dbh;
    
    function __construct() {
        $this->Connect();
    }
    
    function Connect() {
        try {
            $this->dbh = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //echo "you've connected to the database!";
            //var_dump($this->dbh);
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    
    function addr_add_new($f_name, $l_name, $add, $phone, $email) {
        try {
            $data = $this->dbh->prepare('INSERT INTO info (f_name, l_name, address, phone_num, email) VALUES (:fname, :lname, :add, :phone, :email)');
            $data->execute(array('fname'=>$f_name,
                                 'lname'=>$l_name,
                                 'add'=>$add,
                                 'phone'=>$phone,
                                 'email'=>$email));
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
      
    }
    
    function addr_get($f_name, $l_name) {
        $id = $this->dbh->prepare('SELECT id FROM info WHERE f_name = :fname AND l_name = :lname');
        $id->execute(array( 'fname'=>$f_name,
                            'lname'=>$l_name));
        $result = $id->fetchAll();
        if (count($result)) {
            foreach($result as $row) {
                $id = $row['id'];
                $info=$this->dbh->prepare('SELECT * FROM info WHERE id = :id');
                $info->execute(array('id'=>$id));
                $count = $info->fetchAll();
                    foreach ($count as $row) {
                        echo $row['id'] . " " . $row['f_name'] . "<br>";
                    }
            }
        } else {
            echo "No rows returned.";
        }    
    }
    
    function addr_edit() {
        
    }
}
?>