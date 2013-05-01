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
            echo "<table class='t_result'>";
            echo "<tr><td><h3>ID</h3></td>
                      <td><h3>FIRST NAME</h3></td>
                      <td><h3>LAST NAME</h3></td>
                      <td><h3>ADDRESS</h3></td>
                      <td><h3>PHONE #</h3></td>
                      <td><h3>EMAIL</h3></td>";
            foreach($result as $row) {
                $id = $row['id'];
                $info=$this->dbh->prepare('SELECT * FROM info WHERE id = :id');
                $info->execute(array('id'=>$id));
                $count = $info->fetchAll();
                    foreach ($count as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>" . 
                             "<td>" . $row['f_name'] . "</td>" .
                             "<td>" . $row['l_name'] . "</td>" .
                             "<td>" . $row['address'] . "</td>" .
                             "<td>" . $row['phone_num'] . "</td>" .
                             "<td>" . $row['email'] . "</td>" . 
                             "<form action='getedit.php' method='get'>
                             <input type='hidden' name='id' value='" . $row['id'] . "'>
                             <td><input type='submit' value='edit'></td>
                             </form>";
                        echo "</tr>";
                    }
            }
            echo "</table>";
        } else {
            echo "No rows returned.";
        }    
    }
    
    function addr_edit($id) {
        $record = $this->dbh->prepare('SELECT * FROM info WHERE id = :id');
        $record->execute(array( 'id'=>$id));
        $result = $record->fetchAll();
        foreach ($result as $row) { ?>
        <form method="POST" action="processedit.php">
            <table>
                <tr>
                    <td>
                        <label>First Name:</label>
                    </td>
                    <td>
                        <input type="text" name="fname" value="<?php echo $row['f_name'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Last Name:</label>
                    </td>
                    <td>
                        <input type="text" name="lname" value="<?php echo $row['l_name'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Address:</label>
                    </td>
                    <td>
                        <input type="text" name="address" value="<?php echo $row['address'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone Number:</label>
                    </td>
                    <td>
                        <input type="text" name="phonenum" value="<?php echo $row['phone_num'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email:</label>
                    </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $row['email'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type='hidden' id='<?php echo $id ?>' name='id' value='<?php echo $id ?>'>
                        <input type="submit" name="submit" value="Save Changes">
                    </td>
                </tr>
            </table>
        </form>
    <?php }
    }
    function record_change($id, $fname, $lname, $address, $phone, $email) {
        $record = $this->dbh->prepare('UPDATE info SET f_name = :fname,
                                                       l_name = :lname,
                                                       address = :add,
                                                       phone_num = :phone,
                                                       email = :email
                                                       WHERE id = :id');
        if ($record->execute(array( 'id'=>$id,
                                'fname'=>$fname,
                                'lname'=>$lname,
                                'add'=>$address,
                                'phone'=>$phone,
                                'email'=>$email))) {
            echo "Update was successful!";
        } else {
            echo "An error occured and the record could not be updated.";
        }
        //$result = $record->fetchAll();
        //print_r($result);
    }
}
?>