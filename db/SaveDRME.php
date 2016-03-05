
<?php

session_start();
include '../DBCon.php';

$machineID = $_POST["machineID"];
$date = $_POST["date"];
$operatorname = $_POST["operatorname"];
$helpername = $_POST["helpername"];
$startmeter = $_POST["startmeter"];
$endmeter = $_POST["endmeter"];
$messsage = $_POST["remarks"];
$idsite = $_POST["siteID"];
$numberofrows = $_POST["numberofrows"];

echo '<br>';
echo "Machine ID :" . $machineID . '<br>';
echo "Date : " . $date . '<br>';
echo "Operator name : " . $operatorname . '<br>';
echo "Helper Name : " . $helpername . '<br>';
echo "Start Meter  : " . $startmeter . '<br>';
echo "End Meter : " . $endmeter . '<br>';
echo "Remarks :" . $messsage . '<br>';

$sql = "INSERT INTO drme(idinventory,idsite,date,operator,helper,startmeter,endmeter,remarks,status) VALUES('" . $machineID . "','" . $idsite . "','" . $date . "','" . $operatorname . "','" . $helpername . "','" . $startmeter . "','" . $endmeter . "','" . $messsage . "','1')";
if (mysqli_query($con, $sql)) {
    echo "New drme record created successfully";
    echo '<br>';
    echo "Num of Rows : " . $numberofrows . '<br>';

    $worktype = $_POST["worktype0"];
    $areacut = $_POST["areacut0"];
    $areafill = $_POST["areafill0"];
    $material = $_POST["material0"];
    $hours = $_POST["hours0"];
    $tblremarks = $_POST["tblremarks0"];

    echo '<br>';
    echo "Worktype : " . $worktype . '<br>';
    echo "Areacut : " . $areacut . '<br>';
    echo "Areafill : " . $areafill . '<br>';
    echo "Start Meter  : " . $material . '<br>';
    echo "Material : " . $hours . '<br>';
    echo "tblRemarks :" . $tblremarks . '<br>';

    $res = mysqli_query($con, "SELECT MAX(id) FROM drme");
    if ($row = mysqli_fetch_array($res)) {
        $iddrme = $row['MAX(id)'];

        $sql = "INSERT INTO drmeactivity(iddrme,activityno,worktype,areacut,areafill,material,hours,remarks) VALUES('" . $iddrme . "','1','" . $worktype . "','" . $areacut . "','" . $areafill . "','" . $material . "','" . $hours . "','" . $tblremarks . "')";
        if (mysqli_query($con, $sql)) {
            for ($i = 1; $i < $numberofrows; $i++) {
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
                echo "Material  : " . $material . '<br>';
                echo "Hours : " . $hours . '<br>';
                echo "tblRemarks :" . $tblremarks . '<br>';

                $sql = "INSERT INTO drmeactivity(iddrme,activityno,worktype,areacut,areafill,material,hours,remarks) VALUES('" . $iddrme . "','" . ($i + 1) . "','" . $worktype . "','" . $areacut . "','" . $areafill . "','" . $material . "','" . $hours . "','" . $tblremarks . "')";
                if (mysqli_query($con, $sql)) {
                    echo "New drmeactivity record created successfully";
                    continue;
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                    break;
//                    header("Location: ../InsertDRME.php?msg=error");
                }
            }
            echo "Records created successfully";
            header("Location: ../ViewDRME.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
//            header("Location: ../InsertDRME.php?msg=error");
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
//        header("Location: ../InsertDRME.php?msg=error");
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
//    header("Location: ../InsertDRME.php?msg=error");
}
?>
 