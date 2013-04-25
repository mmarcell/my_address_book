<?php
class address {
    var $newAddr;
    var $host = "localhost";
    var $dbname = "addressbook";
    var $user = "root";
    var $pass = "";
    public $dbh;
    public $name = "Mylo";
    
    function __construct() {
        $this->Connect();
    }
    
    function Connect() {
        try {
            $this->dbh = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $data = $this->dbh->prepare('SELECT * FROM info WHERE f_name = :name');
            $data->execute(array('name'=>$this->name));
            while($row = $data->fetch()) {
                print_r($row);
            }
            echo "you've connected to the database!";
            var_dump($this->dbh);
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    
    function addr_add_new($f_name, $l_name, $add) {
        try {
            $data = $this->dbh->prepare('INSERT INTO info (f_name, l_name, address) VALUES (:fname, :lname, :add)');
            $data->execute(array('fname'=>$f_name,
                                 'lname'=>$l_name,
                                 'add'=>$add));
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
      
    }
    
    function addr_get() {
        
    }
    
    function addr_edit() {
        
    }
}

$obj = new address();
$obj->addr_add_new('James', 'Bond', '100 Somewhere');

//$insert = $dbh->prepare("INSERT INTO info(f_name, l_name, address) VALUES :fname, :lname, :add") or die(mysql_error());   
            //$insert->bindParam(':fname', $f_name);
            //$insert->bindParam(':lname', $l_name);
            //$insert->bindParam(':add', $add);
            
            //$insert->execute(); 

//print $obj->addr_add_new('James', 'Bond', '100 Somewhere');

?>