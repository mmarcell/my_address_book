<?php
require_once("header.php");
require_once("class.php");

if (isset($_POST['submit'])) {
    
    $id = $_POST['id'];
    
    if ($_POST['fname'] != "" && $_POST['lname'] != "") {
        $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
        $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    } else {
        echo "Please enter a valid first and last name.";
    }
    
    if ($_POST['address'] != "") {
        $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    } else {
        echo "Please enter a valid address.";
    }
    
    if(preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $_POST['phonenum']) && $_POST['phonenum'] != "") {
        $phone = $_POST['phonenum'];
    } else {
        echo "The number you have entered is invalid.";
    }
    
    if ($_POST['email'] != "") {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    } else {
        echo "Please enter an email address.";
    }

}
if (isset($fname) && isset($lname) && isset($address) && isset($phone) && isset($email)) {
  $rewrite = new address;
  $rewrite->record_change($id, $fname, $lname, $address, $phone, $email);
}
?>