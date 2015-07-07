<?php

include './connection.php';

$selectAll = array();

if (isset($_POST['functionname'])) {
    if ('selectAll' == $_POST['functionname']) {
        $aResult = selectAll();
        echo json_encode($aResult);
    }
}

function insert($con) {
    $id = $_POST['id'];
    $registrationid = $_POST['registrationid'];
    $siteid = $_POST['siteid'];
    $date = $_POST['date'];
    $operator = $_POST['operator'];
    $docjobno = $_POST['docjobno'];
    $presentmeter = $_POST['presentmeter'];
    $nextmeter = $_POST['nextmeter'];
    $status = $_POST['status'];
    $lubricantinfo = $_POST['lubricantinfo'];
    $spareinfo = $_POST['spareinfo'];
    $otherinfo = $_POST['otherinfo'];

    if ($status == 'on') {
        $status = 1;
    } else {
        $status = 0;
    }

    $inventoryid = searchByRegistrationNumber($registrationid);
    //echo $inventoryid;
    //echo $id . ' ' . $inventoryid . ' ' . $siteid . ' ' . $date . ' ' . $operator . ' ' . $status . ' ' . $nextmeter . ' ' . $presentmeter . ' ' . $docjobno;
    $r = mysql_query("INSERT INTO jobcard(id, idinventory, idsite, date, operator, docjobno, presentmeter,nextmeter,status) VALUES('$id','$inventoryid','$siteid','$date','$operator','$docjobno','$presentmeter','$nextmeter','$status')", $con);

    if (!$r) {
        die('Could not insert data: ' . mysql_error());
    } else {
        foreach ($lubricantinfo as $rowData) {
            $data = explode(",", $rowData);
            if ($data[4] == 'on') {
                $lubricantstatus = 1;
            } else {
                $lubricantstatus = 0;
            }
            $r = mysql_query("INSERT INTO lubricant(idjobcard, description, qty, rate, cost, status) VALUES('$id','$data[0]','$data[1]','$data[2]','$data[3]','$lubricantstatus')", $con);
        }


        foreach ($spareinfo as $rowData) {
            $data = explode(",", $rowData);
            if ($data[5] == 'on') {
                $sparestatus = 1;
            } else {
                $sparestatus = 0;
            }
            $r = mysql_query("INSERT INTO spare(idjobcard, description, sno, qty, unitprice, cost, status) VALUES('$id','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$sparestatus')", $con);
        }
        foreach ($otherinfo as $rowData) {
            $data = explode(",", $rowData);
            if ($data[2] == 'on') {
                $otherstatus = 1;
            } else {
                $otherstatus = 0;
            }
            $r = mysql_query("INSERT INTO other(idjobcard, description, cost,status) VALUES('$id','$data[0]','$data[1]','$otherstatus')", $con);
        }
    }
    //header('Location: http://localhost/HovaelConstructions_v1.0/InventoryTypeInsert.php');
}

function update($con) {
    $id = $_POST['id'];
    $registrationid = $_POST['registrationid'];
    $date = $_POST['date'];
    $operator = $_POST['operator'];
    $docjobno = $_POST['docjobno'];
    $presentmeter = $_POST['presentmeter'];
    $nextmeter = $_POST['nextmeter'];
    $status = $_POST['status'];
    $lubricantinfonew = $_POST['lubricantinfonew'];
    $spareinfonew = $_POST['spareinfonew'];
    $otherinfonew = $_POST['otherinfonew'];
    $lubricantinfoold = $_POST['lubricantinfoold'];
    $spareinfoold = $_POST['spareinfoold'];
    $otherinfoold = $_POST['otherinfoold'];

    if ($status == 'on') {
        $status = 1;
    } else {
        $status = 0;
    }

    $siteid=  searchSiteByLocation($_POST['siteid']);
    $inventoryid = searchByRegistrationNumber($registrationid);

    $handle = fopen('count.txt', 'w');
    fwrite($handle,  $id . ' ' . $inventoryid . ' ' . $siteid . ' ' . $date . ' ' . $operator . ' ' . $status . ' ' . $nextmeter . ' ' . $presentmeter . ' ' . $docjobno);
    fclose($handle);
    //echo $inventoryid;
    //echo $id . ' ' . $inventoryid . ' ' . $siteid . ' ' . $date . ' ' . $operator . ' ' . $status . ' ' . $nextmeter . ' ' . $presentmeter . ' ' . $docjobno;
    $r = mysql_query("UPDATE jobcard SET idinventory='$inventoryid', idsite='$siteid', date='$date', operator='$operator', docjobno='$docjobno', presentmeter='$presentmeter',nextmeter='$nextmeter',status='$status' WHERE id='$id'", $con);

    if (!$r) {
        die('Could not insert data: ' . mysql_error());
    } else {
        foreach ($lubricantinfoold as $rowData) {
            $data = explode(",", $rowData);
            if ($data[5] == 'on') {
                $lubricantstatus = 1;
            } else {
                $lubricantstatus = 0;
            }
            $r = mysql_query("UPDATE lubricant SET idjobcard='$id', description='$data[1]', qty='$data[2]', rate='$data[3]', cost='$data[4]', status='$lubricantstatus' WHERE id='$data[0]'", $con);
        }


        foreach ($spareinfoold as $rowData) {
            $data = explode(",", $rowData);
            if ($data[6] == 'on') {
                $sparestatus = 1;
            } else {
                $sparestatus = 0;
            }
            $r = mysql_query("UPDATE spare SET idjobcard='$id', description='$data[1]', sno='$data[2]', qty='$data[3]', unitprice='$data[4]', cost='$data[5]', status='$sparestatus' WHERE id='$data[0]'", $con);
        }
        foreach ($otherinfoold as $rowData) {
            $data = explode(",", $rowData);
            if ($data[3] == 'on') {
                $otherstatus = 1;
            } else {
                $otherstatus = 0;
            }
            $r = mysql_query("UPDATE other SET idjobcard='$id', description='$data[1]', cost='$data[2]',status='$otherstatus' WHERE id='$data[0]'", $con);
        }
        
        foreach ($lubricantinfonew as $rowData) {
            $data = explode(",", $rowData);
            if ($data[4] == 'on') {
                $lubricantstatus = 1;
            } else {
                $lubricantstatus = 0;
            }
            $r = mysql_query("INSERT INTO lubricant(idjobcard, description, qty, rate, cost, status) VALUES('$id','$data[0]','$data[1]','$data[2]','$data[3]','$lubricantstatus')", $con);
        }


        foreach ($spareinfonew as $rowData) {
            $data = explode(",", $rowData);
            if ($data[5] == 'on') {
                $sparestatus = 1;
            } else {
                $sparestatus = 0;
            }
            $r = mysql_query("INSERT INTO spare(idjobcard, description, sno, qty, unitprice, cost, status) VALUES('$id','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$sparestatus')", $con);
        }
        foreach ($otherinfonew as $rowData) {
            $data = explode(",", $rowData);
            if ($data[2] == 'on') {
                $otherstatus = 1;
            } else {
                $otherstatus = 0;
            }
            $r = mysql_query("INSERT INTO other(idjobcard, description, cost,status) VALUES('$id','$data[0]','$data[1]','$otherstatus')", $con);
        }
    }
    //header('Location: http://localhost/HovaelConstructions_v1.0/InventoryTypeInsert.php');
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'insert' == $_POST['function']) {
    insert($con);
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'update' == $_POST['function']) {
    update($con);
}

function searchByRegistrationNumber($regno) {
    $query = "SELECT * FROM inventory where regno='$regno'";

    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result = $row['id'];
                return $result;
            }
        }
    }
}

function selectAll() {
    $query = "SELECT * FROM jobcard";
    $data = array();
    $index = 0;

    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            $result = '';
            while ($row = mysql_fetch_assoc($query_run)) {
                $siteLocation = searchSite($row['idsite']);
                $regNo = searchInventory($row['idinventory']);
                $result .= $row['id'] . ':' . $regNo . ':' . $siteLocation . ':' . $row['date'] . ':' . $row['operator'] . ':' . $row['docjobno'] . ':' . $row['presentmeter'] . ':' . $row['nextmeter'] . ':' . $row['status'];
                $data[$index] = $result;
                $index++;
                $result = '';
            }
        }
    }
    return $data;
}

function searchSite($id) {

    $query = "SELECT * FROM site where id='$id'";

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

function searchSiteByLocation($location) {

    $query = "SELECT * FROM site where location='$location'";

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

?>
