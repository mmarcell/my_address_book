<?php
require_once("class.php");
require_once("header.php");

if (isset($_POST['submit'])) {
    
    if ($_POST['fname'] != "" && $_POST['lname'] != "") {
        $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
        $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    } else {
        echo "Please enter a valid first and last name.";
    }
}
if (isset($fname) && isset($lname)) {
    $obj = new address;
    $obj->addr_get($fname, $lname);
}
?>