<?php
require_once("class.php");

$id = $_GET['id'];
if (isset($id)) {
    $record = new address();
    $record->addr_edit($id);
}

?>