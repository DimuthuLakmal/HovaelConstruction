<?php

include './com.ebox.hovael.db/connection.php';

$table = $_SESSION['table'];

$query = "SELECT * FROM $table order by id desc limit 1;";

if ($query_run = mysql_query($query)) {
    if (mysql_num_rows($query_run) != NULL) {
        while ($row = mysql_fetch_assoc($query_run)) {
            $id = $row["id"] + 1;
        }
    }
}
if (isset($id)) {
    $_SESSION['id'] = $id;
}else{
    $_SESSION['id'] = 1;
}
?>

