
<!--
This is to insert inventory type
author:Dimuthu
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
    <script type="text/javascript" src="./com.ebox.hovael.js/jquery-2.1.3.min.js"></script> 
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <?php
    session_start();
    $_SESSION['table'] = 'jobcard';
    include './com.ebox.hovael.db/autoIncrementID.php';
    ?>
    <body>
        <form id="form">
            <label>Job Card ID : </label>
            <label ><?php echo $_SESSION['id'] ?></label><br>
            <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id" id="id">        
            <label> Registration Number : </label><input type="text" name="registrationid" id="registrationid"><br>
            <label>Site : </label>
            <select id="site" name="site">
            </select><br>
            <label> Date : </label><input type="text" id="date" name="date" size="30" required><br>
            <label> Operator : </label><input type="text" name="operator" id="operator" required><br>
            <label> Doc Job No : </label><input type="text" name="docjobno" id="docjobno" required><br>
            <label> Present Meter: </label><input type="text" name="presentmeter" id="presentmeter" required><br>
            <label> Next Meter: </label><input type="text" name="nextmeter" id="nextmeter" required><br>
            <label> Status : </label><input type="checkbox" name="status" id="status"><br>
            <input type="hidden" name="function" value="insert" disabled>
            <input type="submit" value="Add" id="submit" onclick="insert();">
        </form>

        <div class="container">
            <div id="tabsection">
                <ul class="nav nav-tabs" id="tabs">   
                    <li class="active"><a data-toggle="tab" href="#lubricanttab">Lubricant</a></li>
                    <li><a data-toggle="tab" href="#sparetab">Spare</a></li>
                    <li><a data-toggle="tab" href="#othertab">Other</a></li>
                </ul>
                <div class="tab-content" id="tab-content">
                    <div id="lubricanttab" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px" id="descriptiondiv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Description</label><div class="col-sm-10"><input id="description" type="text" class="form-control"></div></div></form>
                            </div>
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px; display: none" id="qtydiv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Qty</label><div class="col-sm-10"><input id="qty" type="text" class="form-control"></div></div></form>
                            </div>
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px; display: none" id="ratediv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Rate</label><div class="col-sm-10"><input id="rate" type="text" class="form-control"></div></div></form>
                            </div>
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px; display: none" id="costdiv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Cost</label><div class="col-sm-10"><input id="cost" type="text" class="form-control"></div></div></form>
                            </div>
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px; display: none" id="statusdiv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Status</label><div class="col-sm-10"><div class="input-group"><span class="input-group-addon"><input type="checkbox" id="statuslubricant"></span></div></div></div></form>
                            </div>
                            <div id ="lubricantdanger" class="alert alert-danger col-md-5 col-md-offset-4" role="alert" style="display: none; padding: 5px;"><p>Invalid Data type</p></div>
                        </div>
                        <table class="table table-hover" id="lubricanttable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Rate</th>
                                    <th>Cost</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                    <div id="sparetab" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px" id="sparedescriptiondiv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Description</label><div class="col-sm-10"><input id="sparedescription" type="text" class="form-control"></div></div></form>
                            </div>
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px; display: none" id="sparesnodiv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">S no</label><div class="col-sm-10"><input id="sparesno" type="text" class="form-control"></div></div></form>
                            </div>
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px; display: none" id="spareqtydiv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Qty</label><div class="col-sm-10"><input id="spareqty" type="text" class="form-control"></div></div></form>
                            </div>
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px; display: none" id="spareunitpricediv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Unit Price</label><div class="col-sm-10"><input id="spareunitprice" type="text" class="form-control"></div></div></form>
                            </div>
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px; display: none" id="sparecostddiv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Cost</label><div class="col-sm-10"><input id="sparecost" type="text" class="form-control"></div></div></form>
                            </div>
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px; display: none" id="sparestatusdiv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Status</label><div class="col-sm-10"><div class="input-group"><span class="input-group-addon"><input type="checkbox" id="sparestatus"></span></div></div></div></form>
                            </div>
                            <div id ="sparedanger" class="alert alert-danger col-md-5 col-md-offset-4" role="alert" style="display: none; padding: 5px;"><p>Invalid Data type</p></div>
                        </div>
                        <table class="table table-hover" id="sparetable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>S No</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Cost</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div id="othertab" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px" id="otherdescriptiondiv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Description</label><div class="col-sm-10"><input id="otherdescription" type="text" class="form-control"></div></div></form>
                            </div>
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px; display: none" id="othercostdiv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Cost</label><div class="col-sm-10"><input id="othercost" type="text" class="form-control"></div></div></form>
                            </div>
                            <div class="col-md-6 col-md-offset-3" style="padding-top: 20px; display: none" id="otherstatusdiv">
                                <form class="form-horizontal"><div class="form-group"><label class="col-sm-2 control-label">Status</label><div class="col-sm-10"><div class="input-group"><span class="input-group-addon"><input type="checkbox" id="otherstatus"></span></div></div></div></form>
                            </div>
                            <div id ="otherdanger" class="alert alert-danger col-md-5 col-md-offset-4" role="alert" style="display: none; padding: 5px;"><p>Invalid Data type</p></div>
                        </div>
                        <table class="table table-hover" id="othertable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Cost</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>      
        <script src="com.ebox.hovael.js/validation.js"></script>
        <script>
                $(function () {
                    $("#date").datepicker({
                        dateFormat: 'yy-mm-dd'
                    });
                });</script>
        <script>
            $(document).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/Site.php',
                    dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#site').append($('<option></option>').val(text.split(':')[1]).html(text.split(':')[0]));
                                }
                            });
                        }
                        else {
                            console.log(obj.error);
                        }
                    }
                });
            });</script>

        <script>
            var rowid = 1;
            var oldrowid;
            jQuery.ajax({
                type: "POST",
                url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/Lubricant.php',
                dataType: 'json',
                data: {functionname: 'nextid'},
                success: function (obj, textstatus) {
                    if (!('error' in obj)) {
                        $.each(obj, function (val, text) {
                            oldrowid = rowid = obj[0];

                        });
                    }
                    else {
                        console.log(obj.error);
                    }
                }
            });
            //var rowid = 1;
            $('#description').bind('keypress', function (e) {
                if (e.keyCode == 13) {
                    $('#descriptiondiv').hide(250, 'linear');
                    $('#qtydiv').show(250, 'linear', function () {
                        $('#qty').val('');
                        $('#qty').focus();
                        $('#lubricanttable').append("<tr id=\"lubricant" + rowid + "\"><td>" + rowid + "</td><td><input type=\"text\" class=\"form-control\" value=\"" + $('#description').val() + "\"></td></tr>");
                        return false;
                        e.preventDefault();
                    });
                }
            });
            $('#qty').bind('keypress', function (e) {
                if (e.keyCode == 13) {
                    if ($.isNumeric($(this).val())) {
                        $('#lubricantdanger').hide('fast');
                        $('#qtydiv').hide(250, 'linear');
                        $('#ratediv').show(250, 'linear', function () {
                            $('#rate').val('');
                            $('#rate').focus();
                            var tr = "<td><input type=\"text\" class=\"form-control numerical\" value=\"" + $('#qty').val() + "\"></td>";
                            $(tr).appendTo('#lubricant' + rowid);
                        });
                    } else {
                        $('#lubricantdanger').show('fast');
                    }
                }
            });
            $('#rate').bind('keypress', function (e) {
                if (e.keyCode == 13) {
                    if ($.isNumeric($(this).val())) {
                        $('#lubricantdanger').hide('fast');
                        $('#ratediv').hide(250, 'linear');
                        $('#costdiv').show(250, 'linear', function () {
                            $('#cost').val('');
                            $('#cost').focus();
                            var tr = "<td><input type=\"text\" class=\"form-control numerical\" value=\"" + $('#rate').val() + "\"></td>";
                            $(tr).appendTo('#lubricant' + rowid);
                        });
                    } else {
                        $('#lubricantdanger').show('fast');
                    }
                }
            });
            $('#cost').bind('keypress', function (e) {
                if (e.keyCode == 13) {
                    if ($.isNumeric($(this).val())) {
                        $('#lubricantdanger').hide('fast');
                        $('#costdiv').hide(250, 'linear');
                        $('#statusdiv').show(250, 'linear', function () {
                            //$('#status').val('');
                            //$('#status').focus();
                            var tr = "<td><input type=\"text\" class=\"form-control numerical\" value=\"" + $('#cost').val() + "\"></td>";
                            $(tr).appendTo('#lubricant' + rowid);
                        });
                    } else {
                        $('#lubricantdanger').show('fast');
                    }
                }
            });
            $('#statuslubricant').bind('change', function (e) {
                $('#statusdiv').hide(250, 'linear');
                $('#descriptiondiv').show(250, 'linear', function () {
                    $('#description').val('');
                    $('#description').focus();
                    if ($('#statuslubricant').val() == 'on') {
                        var tr = "<td value=\"1\"><input type=\"checkbox\" checked></td>";
                        $(tr).appendTo('#lubricant' + rowid);
                    } else {
                        var tr = "<td value=\"0\"><input type=\"checkbox\"></td>";
                        $(tr).appendTo('#lubricant' + rowid);
                    }

                    rowid++;
                });
            });

        </script>
        <script>
            var sparerowid = 1;
            var oldsparerowid;
            jQuery.ajax({
                type: "POST",
                url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/Spare.php',
                dataType: 'json',
                data: {functionname: 'nextid'},
                success: function (obj, textstatus) {
                    if (!('error' in obj)) {
                        $.each(obj, function (val, text) {
                            oldsparerowid = sparerowid = obj[0];
                        });
                    }
                    else {
                        console.log(obj.error);
                    }
                }
            });

            $('#sparedescription').bind('keypress', function (e) {
                if (e.keyCode == 13) {
                    $('#sparedescriptiondiv').hide(250, 'linear');
                    $('#sparesnodiv').show(250, 'linear', function () {
                        $('#sparesno').val('');
                        $('#sparesno').focus();
                        $('#sparetable').append("<tr id=\"spare" + sparerowid + "\"><td>" + sparerowid + "</td><td><input type=\"text\" class=\"form-control\" value=\"" + $('#sparedescription').val() + "\"></td></tr>");
                    });
                }
            });
            $('#sparesno').bind('keypress', function (e) {
                if (e.keyCode == 13) {
                    $('#sparesnodiv').hide(250, 'linear');
                    $('#spareqtydiv').show(250, 'linear', function () {
                        $('#spareqty').val('');
                        $('#spareqty').focus();
                        var tr = "<td><input type=\"text\" class=\"form-control\" value=\"" + $('#sparesno').val() + "\"></td>";
                        $(tr).appendTo('#spare' + sparerowid);
                    });
                }
            });
            $('#spareqty').bind('keypress', function (e) {
                if (e.keyCode == 13) {
                    if ($.isNumeric($(this).val())) {
                        $('#sparedanger').hide('fast');
                        $('#spareqtydiv').hide(250, 'linear');
                        $('#spareunitpricediv').show(250, 'linear', function () {
                            $('#spareunitprice').val('');
                            $('#spareunitprice').focus();
                            var tr = "<td><input type=\"text\" class=\"form-control numerical\" value=\"" + $('#spareqty').val() + "\"></td>";
                            $(tr).appendTo('#spare' + sparerowid);
                        });
                    } else {
                        $('#sparedanger').show('fast');
                    }
                }
            });
            $('#spareunitprice').bind('keypress', function (e) {
                if (e.keyCode == 13) {
                    if ($.isNumeric($(this).val())) {
                        $('#sparedanger').hide('fast');
                        $('#spareunitpricediv').hide(250, 'linear');
                        $('#sparestatusdiv').show(250, 'linear', function () {
                            //$('#status').val('');
                            //$('#status').focus();
                            var cost = $('#spareunitprice').val() * $('#spareqty').val();
                            var tr = "<td><input type=\"text\" class=\"form-control numerical\" value=\"" + $('#spareunitprice').val() + "\"></td><td><input type=\"text\" class=\"form-control\" value=\"" + cost + "\"></td>";
                            $(tr).appendTo('#spare' + sparerowid);
                        });
                    } else {
                        $('#sparedanger').show('fast');
                    }
                }
            });
            $('#sparestatus').bind('change', function (e) {

                $('#sparestatusdiv').hide(250, 'linear');
                $('#sparedescriptiondiv').show(250, 'linear', function () {
                    $('#sparedescription').val('');
                    $('#sparedescription').focus();
                    if ($('#sparestatus').val() == 'on') {
                        var tr = "<td value=\"1\"><input type=\"checkbox\" checked></td>";
                        $(tr).appendTo('#spare' + sparerowid);
                    } else {
                        var tr = "<td value=\"0\"><input type=\"checkbox\"></td>";
                        $(tr).appendTo('#spare' + sparerowid);
                    }

                    sparerowid++;
                });
            });
        </script>

        <script>
            var otherrowid = 1;
            var oldotherrowid;

            jQuery.ajax({
                type: "POST",
                url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/Other.php',
                dataType: 'json',
                data: {functionname: 'nextid'},
                success: function (obj, textstatus) {
                    if (!('error' in obj)) {
                        $.each(obj, function (val, text) {
                            oldotherrowid = otherrowid = obj[0];
                        });
                    }
                    else {
                        console.log(obj.error);
                    }
                }
            });

            $('#otherdescription').bind('keypress', function (e) {
                if (e.keyCode == 13) {
                    $('#otherdescriptiondiv').hide(250, 'linear');
                    $('#othercostdiv').show(250, 'linear', function () {
                        $('#othercost').val('');
                        $('#othercost').focus();
                        $('#othertable').append("<tr id=\"other" + otherrowid + "\"><td>" + otherrowid + "</td><td><input type=\"text\" class=\"form-control\" value=\"" + $('#otherdescription').val() + "\"></td></tr>");
                    });
                }
            });
            $('#othercost').bind('keypress', function (e) {
                if (e.keyCode == 13) {
                    if ($.isNumeric($(this).val())) {
                        $('#otherdanger').hide('fast');
                        $('#othercostdiv').hide(250, 'linear');
                        $('#otherstatusdiv').show(250, 'linear', function () {
                            //$('#otherstatus').val('');
                            //$('#otherstatus').focus();
                            var tr = "<td><input type=\"text\" class=\"form-control numerical\" value=\"" + $('#othercost').val() + "\"></td>";
                            $(tr).appendTo('#other' + otherrowid);
                        });
                    } else {
                        $('#otherdanger').show('fast');
                    }
                }
            });
            $('#otherstatus').bind('change', function (e) {

                $('#otherstatusdiv').hide(250, 'linear');
                $('#otherdescriptiondiv').show(250, 'linear', function () {
                    $('#otherdescription').val('');
                    $('#otherdescription').focus();
                    if ($('#otherstatus').val() == 'on') {
                        var tr = "<td value=\"1\"><input type=\"checkbox\" checked></td>";
                        $(tr).appendTo('#other' + otherrowid);
                    } else {
                        var tr = "<td value=\"0\"><input type=\"checkbox\"></td>";
                        $(tr).appendTo('#other' + otherrowid);
                    }

                    otherrowid++;
                });
            });
        </script>
        <script type="text/javascript">
            function disableF5(e) {
                if ((e.which || e.keyCode) == 13)
                    e.preventDefault();
            }
            ;
            $(document).ready(function () {
                $(document).on("keypress", disableF5);
            });
        </script>
        <script>
            function insert() {
                $id = $('#id').val();
                $siteid = $('#site').val();
                $registrationid = $('#registrationid').val();
                $date = $('#date').val();
                $operator = $('#operator').val();
                $nextmeter = $('#nextmeter').val();
                $presentmeter = $('#presentmeter').val();
                $docjobno = $('#docjobno').val();
                $status = $('#status').val();
                $lubricantInfo = [];
                $spareInfo = [];
                $otherInfo = [];

                $isAllNurical = true;
                $('.numerical').each(function () {
                    if (!$.isNumeric($(this).val())) {
                        $isAllNurical = false;
                    }
                });
                
                if ($isAllNurical && $.isNumeric($nextmeter) && isDate($date) && $.isNumeric($presentmeter) && $registrationid!='' && $date!='' && $operator!='' && $nextmeter!='' && $presentmeter!='' && $docjobno!='') {
                    for (i = oldrowid; i < rowid; i++) {
                        $rowData = '';
                        $('#lubricant' + i + ' td').each(function () {
                            var input = $("input");
                            if ($(this).find(input).val() != null) {
                                $rowData += $(this).find(input).val() + ',';
                            }

                        });
                        $lubricantInfo[i - 1] = $rowData;
                    }
                    for (i = oldsparerowid; i < sparerowid; i++) {
                        $rowData = '';
                        $('#spare' + i + ' td').each(function () {
                            var input = $("input");
                            if ($(this).find(input).val() != null) {
                                $rowData += $(this).find(input).val() + ',';
                            }

                        });
                        $spareInfo[i - 1] = $rowData;
                    }
                    for (i = oldotherrowid; i < otherrowid; i++) {
                        $rowData = '';
                        $('#other' + i + ' td').each(function () {
                            var input = $("input");
                            if ($(this).find(input).val() != null) {
                                $rowData += $(this).find(input).val() + ',';
                            }

                        });
                        $otherInfo[i - 1] = $rowData;
                    }


                    //                alert($id + ' ' + $siteid + ' ' + $registrationid + ' ' + $date + ' ' + $operator + ' ' + $nextmeter + ' ' + $presentmeter + ' ' + $docjobno + ' ' + $status);
                    jQuery.ajax({
                        type: "POST",
                        url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/JobCard.php',
                        dataType: 'json',
                        data: {function: 'insert', id: $id, siteid: $siteid, registrationid: $registrationid, date: $date, operator: $operator, nextmeter: $nextmeter, presentmeter: $presentmeter, docjobno: $docjobno, status: $status, lubricantinfo: $lubricantInfo, spareinfo: $spareInfo, otherinfo: $otherInfo},
                        success: function (obj, textstatus) {
                            if (!('error' in obj)) {

                            }
                            else {
                                console.log(obj.error);
                            }
                        }
                    });
                    location.reload();
                } else {
                    alert('Something is wrong');
                }
            }

        </script>
        <script>
            $("#form").submit(function (e) {
                e.preventDefault();
            });
        </script>

    </body>
</html>