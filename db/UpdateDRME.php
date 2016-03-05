<?php

session_start();
include '../DBCon.php';

echo '<br>';
$numberofrows = $_POST["numberofrows"];
$initialrows = $_POST["initialrows"];
echo "Num of Rows : " . $numberofrows . '<br>';
echo "Initial row count :" . $initialrows . '<br>';

$id = $_POST['ID'];
$machineID = $_POST["machineID"];
$date = $_POST["date"];
$operatorname = $_POST["operatorname"];
$helpername = $_POST["helpername"];
$startmeter = $_POST["startmeter"];
$endmeter = $_POST["endmeter"];
$messsage = $_POST["remarks"];

echo '<br>';
echo "Drme ID : " . $id . '<br>';
echo "Machine ID :" . $machineID . '<br>';
echo "Date : " . $date . '<br>';
echo "OPerator name : " . $operatorname . '<br>';
echo "Helper Name : " . $helpername . '<br>';
echo "Start Meter  : " . $startmeter . '<br>';
echo "End Meter : " . $endmeter . '<br>';
echo "Remarks :" . $messsage . '<br>';

$sql = "UPDATE drme SET idinventory = '" . $machineID . "', date ='" . $date . "', operator ='" . $operatorname . "', helper='" . $helpername . "',startmeter='" . $startmeter . "',endmeter='" . $endmeter . "',remarks='" . $messsage . "'  WHERE id='" . $id . "' ";

if (mysqli_query($con, $sql)) {
    echo "New record created successfully";

    for ($i = 0; $i < $initialrows; $i++) {
        $worktype = $_POST[$i . "1"];
        $areacut = $_POST[$i . "2"];
        $areafill = $_POST[$i . "3"];
        $material = $_POST[$i . "4"];
        $hours = $_POST[$i . "5"];
        $tblremarks = $_POST[$i . "6"];

        echo '<br>';
        echo "Worktype : " . $worktype . '<br>';
        echo "Areacut : " . $areacut . '<br>';
        echo "Areafill : " . $areafill . '<br>';
        echo "Start Meter  : " . $material . '<br>';
        echo "Material : " . $hours . '<br>';
        echo "tblRemarks :" . $tblremarks . '<br>';

        $sql = "UPDATE drmeactivity SET worktype = '" . $worktype . "', areacut ='" . $areacut . "', areafill ='" . $areafill . "', material='" . $material . "',hours='" . $hours . "',remarks='" . $tblremarks . "' WHERE iddrme='" . $id . "' and activityno ='" . ($i + 1) . "' ";

        if (mysqli_query($con, $sql)) {
            echo "New record created successfully";

            if ($numberofrows > $initialrows) {
                for ($i = $initialrows; $i < $numberofrows; $i++) {
                    $worktype = $_POST[$i . "1"];
                    $areacut = $_POST[$i . "2"];
                    $areafill = $_POST[$i . "3"];
                    $material = $_POST[$i . "4"];
                    $hours = $_POST[$i . "5"];
                    $tblremarks = $_POST[$i . "6"];

                    echo '<br>';
                    echo "Worktype : " . $worktype . '<br>';
                    echo "Areacut : " . $areacut . '<br>';
                    echo "Areafill : " . $areafill . '<br>';
                    echo "Start Meter  : " . $material . '<br>';
                    echo "Material : " . $hours . '<br>';
                    echo "tblRemarks :" . $tblremarks . '<br>';

//                    $sql = "UPDATE drmeactivity SET worktype = '" . $worktype . "', areacut ='" . $areacut . "', areafill ='" . $areafill . "', material='" . $material . "',hours='" . $hours . "',remarks='" . $tblremarks . "',WHERE iddrme='" . $id . "' and activitynumber ='" . ($i + 1) . "' ";
                    $sql = "INSERT INTO drmeactivity(activityno,worktype,areacut,areafill,material,hours,remarks,iddrme) VALUES('" . ($i + 1) . "','" . $worktype . "','" . $areacut . "','" . $areafill . "','" . $material . "','" . $hours . "','" . $tblremarks . "','" . $id . "')";

                    if (mysqli_query($con, $sql)) {
                        echo "New record created successfully";
                        header("Location: ../ViewDRME.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($con);
                        header("Location: ../ViewDRME.php?msg=error");
                    }
                }
            } else {
                header("Location: ../ViewDRME.php");
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
            header("Location: ../ViewDRME.php?msg=error");
        }
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
    header("Location: ../ViewDRME.php?msg=error");
}
?>
 