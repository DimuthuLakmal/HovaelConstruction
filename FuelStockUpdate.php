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

        <div class="container">
            <table class="table table-hover" id="viewtable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Site</th>
                        <th>Name</th>
                        <th>Operator</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div id="modalWindow" class="col-md-6 portBox" style="display: none">
            <div class="col-md-6 col-md-offset-3">
                <form action="com.ebox.hovael.db/FuelStock.php" method="POST" id="updateForm">
                    <label>Fuel ID : </label>
                    <label id="idLabel"></label><br>
                    <input type="hidden" name="id" id="id">
                    <label>Site : </label>
                    <select id="site" name="site">
                    </select><br>
                    <label> Name : </label><input type="text" name="name" id="name" required><br>
                    <label> Price : </label><input type="text" name="price" id="price" required><br>
                    <label> Qty : </label><input type="text" name="qty" id="qty" required><br>
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

        <script>
            $(document).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/SiteToController.php', dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#site').append($('<option></option>').val(text.split(':')[0]).html(text.split(':')[0]));
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
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/FuelStock.php',
                    dataType: 'json',
                    data: {functionname: 'selectAll'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var columns = ['id', 'site', 'name', 'price', 'qty'];
                            $.each(obj, function (key, value) {
                                var cellData = value.split(':');
                                $('#viewtable tbody').append("<tr id=\"row" + cellData[0] + "\"></tr>");
                                var columnNumber = 0;
                                $.each(cellData, function (key, value) {
                                    if (columnNumber != 6) {
                                        $('#row' + cellData[0]).append("<td id=\"row" + cellData[0] + columns[columnNumber] + "\">" + value + "</td>");
                                    }
                                    columnNumber++;
                                });

//                                if (cellData[columnNumber] = '1') {
//                                    $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></label><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span></td>");
//                                } else {
//                                    $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></label><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></td>");
//                                }
                                $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></td>");
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
                var columns = ['id', 'site', 'name', 'price', 'qty', 'status'];
                $('#idLabel').html(id);
                $('#id').val(id);
                $("#site option[value='" + $('#row' + id + 'site').html() + "']").attr("selected", "selected");
                $('#name').val($('#row' + id + 'name').html());
                $('#price').val($('#row' + id + 'price').html());
                $('#qty').val($('#row' + id + 'qty').html());
                $('#modalWindow').show();
                $('#modalButton').click();
            }

        </script>

        <script>
//            var allInputs = $(":input");
//
//            $.each(allInputs, function (key, value) {
//
//                $(value).focusout(function () {
//                    if ($.isNumeric($('#price').val()) && $.isNumeric($('#qty').val())) {
//                        $('#submit').removeAttr('disabled');
//                    } else {
//                        $('#submit').attr('disabled', true);
//                    }
//                });
//
//            });
//            $('#site').change(function () {
//                
//                if ($.isNumeric($('#price').val()) && $.isNumeric($('#qty').val())) {
//                    $('#submit').removeAttr('disabled');
//                } else {
//                    $('#submit').attr('disabled', true);
//                }
//            });
//
//            $('#status').change(function () {
//                if ($.isNumeric($('#price').val()) && $.isNumeric($('#qty').val())) {
//                    $('#submit').removeAttr('disabled');
//                } else {
//                    $('#submit').attr('disabled', true);
//                }
//            });

            $(document).on('submit', '#updateForm', function () {
                if (!$.isNumeric($('#price').val()) || !$.isNumeric($('#qty').val())) {
                    event.preventDefault();
                    alert('Please fill correctly');
                }
            });
        </script>

    </body>
</html>
