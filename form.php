<?php require_once("class.php"); ?>
<!DOCTYPE html>

<html>
<head>
    <title>Address Form</title>
</head>

<body>
<form action="process.php" method="post">
    <table>
        <tr>
            <td>
                <label>First Name:</label>
            </td>
            <td>
                <input type="text" name="fname">
            </td>
        </tr>
        <tr>
            <td>
                <label>Last Name:</label>
            </td>
            <td>
                <input type="text" name="lname">
            </td>
        </tr>
        <tr>
            <td>
                <label>Address:</label>
            </td>
            <td>
                <input type="text" name="address">
            </td>
        </tr>
        <tr>
            <td>
                <label>Phone Number:</label>
            </td>
            <td>
                <input type="text" name="phonenum">
            </td>
        </tr>
        <tr>
            <td>
                <label>Email:</label>
            </td>
            <td>
                <input type="text" name="email">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="submit" value="Add">
            </td>
        </tr>
    </table>
</form>


</body>
</html>
