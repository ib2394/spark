<?php
session_start();
include ('../../config/config.php');

$adminid= $_POST["admin"];

$sql = "delete from admin where adminid='$adminid'";
$result = mysqli_query($con,$sql);
if($result == true)
    echo "Successfully Remove";
else
    echo "Error 
    $sql<br>".mysqli_error($con);
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="borang.css">
    <link rel="stylesheet" href="button.css">
    <h3>PADAM GURU</h3>
    <form action="deleteAdm.php" method="post"> 
        <table> 
            <tr>
                <td>Admin ID</td>
                <td><input type="text" id="adminid" name="adminid" placeholder="G000" pattern="[A-Z0-9]{4}" oninvalid="this.setCustomValidity('Please Enter Admin ID')" oninput="this.setCustomValidity('')"></td>
            </tr>
        </table>
        <button class="padam" type="submit">DELETE</button>
    </form>
</html>