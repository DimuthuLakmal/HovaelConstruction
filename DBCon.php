<?php
$con = mysqli_connect("localhost", "root", "123", "hovael", "3306");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL : " . mysqli_connect_errno();
} else {
//    echo '<h5>MySQL connected :P</h5>';
}
?>