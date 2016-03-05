<?php

function isSessionAvailable() {
    if ($_SESSION == NULL) {
        return FALSE;
    }
    return TRUE;
}

function isStatusOK() {
    if (isset($_SESSION['status'])) {
        $status = $_SESSION['status'];
        if ($status == '1') {
            return TRUE;
        }
    }
    return FALSE;
}

function isAdmin() {
    $type = $_SESSION['type'];
    if ($type == "Super Admin" || $type == "Admin" || $type == "Manager") {
        return TRUE;
    }
    return FALSE;
}

?>