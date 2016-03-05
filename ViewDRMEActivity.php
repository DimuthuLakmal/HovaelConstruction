<div class="row">
    <div class="col-md-12">                                    
        <div class="box box-info">
            <div class="register-box-body">

                <table class="table table-hover">
                    <?php
                    session_start();
                    include './DBCon.php';
                    $id = $_GET["id"];
                    $sql = "SELECT * FROM drmeactivity WHERE iddrme=$id";
                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        ?>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Activity No</th>
                                <th>Work Type</th>
                                <th>Area (Cut)</th>
                                <th>Area (Fill)</th>
                                <th>Material</th>
                                <th>Hours</th>
                                <th>Remarks</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row["id"] ?></td>
                                    <td><?php echo $row["activityno"] ?></td>
                                    <td><?php echo $row["worktype"] ?></td>
                                    <td><?php echo $row["areacut"] ?></td>
                                    <td><?php echo $row["areafill"] ?></td>
                                    <td><?php echo $row["material"] ?></td>
                                    <td><?php echo $row["hours"] ?></td>
                                    <td><?php echo $row["remarks"] ?></td>                                                           
                                </tr>
                            <?php } ?>
                        </tbody>
                        <?php
                    } else {
                        echo "No matching records found";
                    }
                    ?>
                </table>

            </div>
        </div>
    </div>
</div>