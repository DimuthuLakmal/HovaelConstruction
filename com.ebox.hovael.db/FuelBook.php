<?php

session_start();
header('Content-Type: application/json');
include './connection.php';

$selectAll = array();
$aResult = array();

if (isset($_POST['functionname'])) {
    if ('selectAll' == $_POST['functionname']) {
        $aResult = selectAll();
        echo json_encode($aResult);
    }
    if ('searchBetween' == $_POST['functionname']) {
        $aResult = searchBetween();
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $aResult[0]);

        fclose($myfile);
        echo json_encode($aResult);
    }
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'insert' == $_POST['function']) {
    insert($con);
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'update' == $_POST['function']) {
    update($con);
}

function searchBetween() {
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $query = "SELECT * FROM fuelbook WHERE date BETWEEN '$fromdate' and '$todate'";
    $data = array();
    $index = 0;

    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            $result = '';
            while ($row = mysql_fetch_assoc($query_run)) {
                $code = searchInventory1($row['idinventory']);
                $regno = searchInventory($row['idinventory']);
                $site = searchSite($row['idsite']);
                $result .= $row['id'] . ':' . $code . ':' . $regno . ':' . $site . ':' . $row['name'] . ':' . $row['date'] . ':' . $row['qty'] . ':' . $row['meterreading'] . ':' . $row['remarks'] . ':' . $row['status'];
                $data[$index] = $result;
                $index++;
                $result = '';
            }
        }
    }
    return $data;
}

function insert($con) {
    $id = $_POST['id'];
    $idsite = $_POST['idsite'];
    $code = $_POST['code'];
    $fuel = $_POST['fuel'];
    $date = $_POST['date'];
    $qty = $_POST['qty'];
    $meterReading = $_POST['meterreading'];
    $remarks = $_POST['remarks'];

//    $fuelId = searchFromName($fuelName);
//    $idinventory = searchByRegistrationNumber($regno);
    $idinventory = searchByCode($code);

    $inQty = 0;
    $query = "SELECT qty FROM fuelstock WHERE idsite='$idsite' AND name='$fuel' AND status!=0";
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $inQty += $row['qty'];
            }
        }
    }

    $outQty = 0;
    $query = "SELECT qty FROM fuelbook WHERE idsite='$idsite' AND name='$fuel' AND status!=0";
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $outQty += $row['qty'];
            }
        }
    }

    $newQty = $inQty - $outQty - $qty;
    if ($newQty >= 0) {
        $r = mysql_query("INSERT INTO fuelbook(id,idinventory,idsite,name,date,qty,meterreading,remarks,status) VALUES('$id','$idinventory','$idsite','$fuel','$date','$qty','$meterReading','$remarks','1')", $con);
        if (!$r) {
            header('Location: ../FuelBookInsert.php?msg=error');
        }
//        $res = mysql_query("UPDATE fuelstock SET qty='$newQty' WHERE idsite='$idsite' AND name='$fuel'", $con);
//        if (!$res) {
//            header('Location: ../FuelBookInsert.php?msg=error');
//        }
        header('Location: ../FuelBookView.php');
    } else {
        header('Location: ../FuelBookInsert.php?msg=notenough');
    }
}

function searchFromName($name) {
    $site = $_SESSION['location'];
    $query = "SELECT fuelstock.id FROM fuelstock JOIN site ON fuelstock.idsite=site.id WHERE site.location='$site' AND fuelstock.name='$name' AND status!=0";
//    $query = "SELECT * FROM fuelstock WHERE id=$name";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result = $row['id'];
            }
        }
    }
    return $result;
}

function searchByRegistrationNumber($regno) {

    $query = "SELECT * FROM inventory where regno='$regno'";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['id'];
            }
        }
    }
    return $result;
}

function searchByCode($code) {

    $query = "SELECT * FROM inventory where code='$code'";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['id'];
            }
        }
    }
    return $result;
}

function searchInventory($id) {

    $query = "SELECT * FROM inventory where id='$id'";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['regno'];
            }
        }
    }
    return $result;
}

function searchInventory1($id) {

    $query = "SELECT * FROM inventory where id='$id'";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['code'];
            }
        }
    }
    return $result;
}

function searchSite($id) {

    $query = "SELECT * FROM site WHERE id='$id'";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['location'];
            }
        }
    }
    return $result;
}

function selectAll() {
    $query = "SELECT * FROM fuelbook";
    $data = array();
    $index = 0;

    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            $result = '';
            while ($row = mysql_fetch_assoc($query_run)) {
                $code = searchInventory1($row['idinventory']);
                $regno = searchInventory($row['idinventory']);
                $site = searchSite($row['idsite']);
                $result .= $row['id'] . ':' . $code . ':' . $regno . ':' . $site . ':' . $row['name'] . ':' . $row['date'] . ':' . $row['qty'] . ':' . $row['meterreading'] . ':' . $row['remarks'] . ':' . $row['status'];
                $data[$index] = $result;
                $index++;
                $result = '';
            }
        }
    }
    return $data;
}

function update($con) {
    $id = $_POST['id'];
    $code = $_POST['code'];
//    $regno = $_POST['regno'];
    $fuelName = $_POST['fuel'];
    $date = $_POST['date'];
    $qty = $_POST['qty'];
    $meterReading = $_POST['meterreading'];
    $remarks = $_POST['remarks'];

//    $fuelId = searchFromName($fuelName);
//    $idinventory = searchByRegistrationNumber($regno);
//    $idinventory = searchByCode($code);

    $r = mysql_query("UPDATE fuelbook SET name='$fuelName',date='$date',qty='$qty',meterreading='$meterReading',remarks='$remarks' WHERE id='$id'", $con);
    if (!$r) {
        header('Location: ../FuelBookView.php?msg=error');
    }
    header('Location: ../FuelBookView.php');
}

?>
