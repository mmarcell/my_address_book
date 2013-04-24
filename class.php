<?php
class address {
    var $newAddr;
    var $host = "localhost";
    var $dbname = "addressbook";
    var $user = "root";
    var $pass = "";
    var $dbh;
    
    function __construct() {
        $this->Connect();
    }
    
    function Connect() {
        $this->dbh = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
    }
    function Test() {
        if (isset($this->dbh)) {
            echo "you've successfully connected to the database";
        }
    }
    
    function addr_add_new($f_name, $l_name, $add) {
        try {
            $this->dbh->prepare("INSERT INTO info(f_name, l_name, address) VALUES ($f_name, $l_name, $add)");   
        }
        catch(PDOException $e) {  
            echo "I'm sorry, Mylo. I'm afraid I can't do that.";  
            file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
        } 
    }
    
    function addr_get() {
        
    }
    
    function addr_edit() {
        
    }
}

$obj = new address();
print $obj->Test();
print $obj->addr_add_new('James', 'Bond', '100 Somewhere');

?>