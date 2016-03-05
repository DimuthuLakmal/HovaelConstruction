<?php

session_start();
include '../DBCon.php';
include '../ctrl/checkSiteValidity.php';
if ($_SESSION != NULL) {
    $log_id = $_SESSION['idlog'];
    $pw = md5($_POST['pw']);

    $date_time = date('Y-m-d H:i:s');
    // Function to get the client IP address
    $ip = getenv('HTTP_CLIENT_IP')? :
            getenv('HTTP_X_FORWARDED_FOR')? :
                    getenv('HTTP_X_FORWARDED')? :
                            getenv('HTTP_FORWARDED_FOR')? :
                                    getenv('HTTP_FORWARDED')? :
                                            getenv('REMOTE_ADDR');

    $res = mysqli_query($con, "SELECT * FROM log WHERE id='$log_id'");
    if ($row = mysqli_fetch_array($res)) {
        if ($pw == $row['pw']) {
            $_SESSION['status'] = '1';

            $res = mysqli_query($con, "INSERT INTO loginsession(intime,ip,iduser) VALUES
                ('" . $date_time . "','" . $ip . "','" . $_SESSION['iduser'] . "')");
            if ($res) {
                checkSitesExpired();
                header('location:../Home.php');
            } else {
                header('location:../LockScreen.php?msg=error');
            }
        } else {
            header('location:../LockScreen.php?msg=error');
        }
    } else {
        header('location:../LockScreen.php?msg=error');
    }
} else {
    $un = $_POST['un'];
    $pw = md5($_POST['pw']);

    $res = mysqli_query($con, "SELECT * FROM log JOIN user ON log.id = user.id JOIN userinfo ON user.iduserinfo = userinfo.id JOIN usertype ON user.idusertype = usertype.id JOIN site ON userinfo.work = site.id WHERE un='$un' AND pw='$pw' AND user.status='1'");
    if ($row = mysqli_fetch_array($res)) {
        $_SESSION['iduser'] = $row[3];
        $_SESSION['idlog'] = $row['id'];
        $_SESSION['status'] = '1';
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['desig'] = $row['designation'];
        $_SESSION['location'] = $row['location'];
        $_SESSION['mobile'] = $row['mobile'];
        $_SESSION['type'] = $row['type'];

        $date_time = date('Y-m-d H:i:s');
        // Function to get the client IP address
        $ip = getenv('HTTP_CLIENT_IP')? :
                getenv('HTTP_X_FORWARDED_FOR')? :
                        getenv('HTTP_X_FORWARDED')? :
                                getenv('HTTP_FORWARDED_FOR')? :
                                        getenv('HTTP_FORWARDED')? :
                                                getenv('REMOTE_ADDR');

        $res = mysqli_query($con, "INSERT INTO loginsession(intime,ip,iduser) VALUES
        ('" . $date_time . "','" . $ip . "','" . $_SESSION['iduser'] . "')");
        if ($res) {
            checkSitesExpired();
            header('location:../Home.php');
        } else {
            header('location:../Index.php?msg=error');
        }
    } else {
        header('location:../Index.php?msg=error');
    }
}
?>
