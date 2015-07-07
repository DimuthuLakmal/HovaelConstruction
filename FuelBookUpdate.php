<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>

    <body>

        <button data-display="modalWindow" data-animation="fade" data-animationspeed="300" data-closeBGclick="true" id="modalButton" style="display: none">My Project</button><br>

        <label> From : </label><input type="text" id="fromdate" name="fromdate" size="30">
        <label> To : </label><input type="text" id="todate" name="todate" size="30">
        <div class="container">
            <table class="table table-hover" id="viewtable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Reg No</th>
                        <th>Fuel</th>
                        <th>Date</th>
                        <th>Qty</th>
                        <th>Meter Readings</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div id="modalWindow" class="col-md-6 portBox">
            <div class="col-md-6 col-md-offset-3">
                <form action="com.ebox.hovael.db/FuelBook.php" method="POST">
                    <label>Fuel Book ID : </label>
                    <label id="idLabel"></label><br>
                    <input type="hidden" name="id" id="id">

                    <label> Reg No : </label><input type="text" name="regno" id="regno"><br>
                    <label>Fuel : </label>
                    <select id="fuel" name="fuel">
                    </select><br>
                    <label> Date : </label><input type="text" id="date" name="date" size="30" required><br>
                    <label> Qty : </label><input type="text" name="qty" id="qty" required><br>
                    <label> Meter Reading : </label><input type="text" name="meterreading" id="meterreading" required><br>
                    <label> Remarks : </label><input type="text" name="remarks" id="remarks"><br>
                    <label> Status : </label><input type="checkbox" name="status" id="status"><br>
                    <input type="hidden" value="update" name="function">
                    <input type="submit" value="Update" id="submit">
                </form>
            </div>
        </div>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>      
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="com.ebox.hovael.js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="com.ebox.hovael.js/portBox.slimscroll.min.js"></script>
        <link href="com.ebox.hovael.css/portBox.css" rel="stylesheet" />
        <script src="com.ebox.hovael.js/validation.js"></script>

        <script>
            $(document).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/FuelStock.php',
                    dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#fuel').append($('<option></option>').val(text.split(':')[1]).html(text.split(':')[0]));
                                }
                            });
                        }
                        else {
                            console.log(obj.error);
                        }
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/FuelBook.php',
                    dataType: 'json',
                    data: {functionname: 'selectAll'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var columns = ['id', 'regno', 'fuel', 'date', 'qty', 'meterreading', 'remarks'];
                            $.each(obj, function (key, value) {
                                var cellData = value.split(':');
                                $('#viewtable tbody').append("<tr id=\"row" + cellData[0] + "\"></tr>");
                                var columnNumber = 0;
                                $.each(cellData, function (key, value) {
                                    if (columnNumber != 7) {
                                        $('#row' + cellData[0]).append("<td id=\"row" + cellData[0] + columns[columnNumber] + "\">" + value + "</td>");
                                    }
                                    columnNumber++;
                                });

                                if (cellData[7] == '1') {
                                    $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></label><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span></td>");
                                } else {
                                    //alert('cellData[7]');
                                    $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></label><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></td>");
                                }
                                $('#row' + cellData[0]).append("<td><button class=\"btn btn-primary\" onclick=\"update('" + cellData[0] + "')\" id=\"button" + cellData[0] + "\">Update</button></td>");

                            });


                        }
                        else {
                            console.log(obj.error);
                        }
                    }
                });
            });
        </script>

        <script>
            function update(id) {
                var columns = ['id', 'idinventory', 'idfuelstock', 'date', 'qty', 'meterreading', 'remarks'];
                $('#idLabel').html(id);
                $('#id').val(id);
                $('#regno').val($('#row' + id + 'regno').html());
                $("#fuel option[value='" + $('#row' + id + 'fuel').html() + "']").attr("selected", "selected");
                $('#date').val($('#row' + id + 'date').html());
                $('#qty').val($('#row' + id + 'qty').html());
                $('#meterreading').val($('#row' + id + 'meterreading').html());
                $('#remarks').val($('#row' + id + 'remarks').html());

                if ($('#row' + id + "status").val() == '1') {
                    $('#status').prop('checked', true);
                }

                $('#modalButton').click();
            }

        </script>
        <script>
            $(function () {
                $("#date").datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });
        </script>
        <script>
            $(function () {
                $("#fromdate").datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });
            $(function () {
                $("#todate").datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });
        </script>
        <script>
            $('#todate').change(function () {
                $('#viewtable tbody tr').hide('slow');
                $fromdate = $('#fromdate').val();
                $todate = $('#todate').val();
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/FuelBook.php',
                    dataType: 'json',
                    data: {functionname: 'searchBetween', fromdate: $fromdate, todate: $todate},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var columns = ['id', 'regno', 'fuel', 'date', 'qty', 'meterreading', 'remarks'];
                            $.each(obj, function (key, value) {
                                var cellData = value.split(':');
                                alert(value);
                                $('#viewtable tbody').append("<tr id=\"row" + cellData[0] + "\"></tr>");
                                var columnNumber = 0;
                                $.each(cellData, function (key, value) {
                                    if (columnNumber != 7) {
                                        $('#row' + cellData[0]).append("<td id=\"row" + cellData[0] + columns[columnNumber] + "\">" + value + "</td>");
                                    }
                                    columnNumber++;
                                });

                                if (cellData[7] == '1') {
                                    $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></label><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span></td>");
                                } else {
                                    //alert('cellData[7]');
                                    $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></label><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></td>");
                                }
                                $('#row' + cellData[0]).append("<td><button class=\"btn btn-primary\" onclick=\"update('" + cellData[0] + "')\" id=\"button" + cellData[0] + "\">Update</button></td>");

                            });


                        }
                    }
                });
            });
        </script>
        <script>
            $isDateOk = true;
            $isRegNoOk = true;
            $('#date').change(function () {
                if (isDate($(this).val())) {
                    $isDateOk = true;
                } else {
                    $isDateOk = false;
                }
            });

            $('#regno').focusout(function () {
                var x = $(this).val().split('-');
                if ($.isNumeric(x[0]) && $.isNumeric(x[1])) {
                    $isRegNoOk = true;
                } else {
                    var matches = $(this).val().match(/\d+/g);
                    if (matches != null && $.isNumeric(x[1])) {
                        $isRegNoOk = true;
                    }
                    else {
                        $isRegNoOk = false;
                    }
                }
            });

            var allInputs = $(":input");

            $.each(allInputs, function (key, value) {

                $(value).focusout(function () {
                    if ($isDateOk && $isRegNoOk && $.isNumeric($('#meterreading').val()) && $.isNumeric($('#qty').val())) {
                        $('#submit').removeAttr('disabled');
                    } else {
                        $('#submit').attr('disabled', true);
                    }
                });

            });
            $('#fuel').change(function () {

                if ($isDateOk && $isRegNoOk && $.isNumeric($('#meterreading').val()) && $.isNumeric($('#qty').val())) {
                    $('#submit').removeAttr('disabled');
                } else {
                    $('#submit').attr('disabled', true);
                }
            });

            $('#status').change(function () {
                if ($isDateOk && $isRegNoOk && $.isNumeric($('#meterreading').val()) && $.isNumeric($('#qty').val())) {
                    $('#submit').removeAttr('disabled');
                } else {
                    $('#submit').attr('disabled', true);
                }
            });

        </script>
    </body>
</html>
