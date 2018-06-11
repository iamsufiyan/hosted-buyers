<?php
$this->load->view('head_foot/header');
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
}
?>
<script>
    function get_event_name(val) {
<?php $base = base_url(); ?>
        var url = "<?php echo"$base"; ?>index.php/Admin_registration/get_event_name/" + val;
        $.ajax({
            type: 'post',
            url: url,
            success: function (response) {
                document.getElementById("event_name").value = response;
            }
        });
    }
    function get_event_date(val) {
<?php $base = base_url(); ?>
        var url = "<?php echo"$base"; ?>index.php/Admin_registration/get_event_date/" + val;
        $.ajax({
            type: 'post',
            url: url,
            success: function (response) {
                document.getElementById("edate").value = response;
            }
        });
    }
    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for (var i = 1; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
        } catch (e) {
            alert(e);
        }
        sumcal("table1");
    }
    function addRow(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        //alert(rowCount);

        var cell1 = row.insertCell(0);
        var element1 = document.createElement("input");
        element1.type = "checkbox";
        element1.name = "chkbox[]";
        element1.style = "width:20px";
        cell1.appendChild(element1);

        var cell2 = row.insertCell(1);
        var element2 = document.createElement("input");
        element2.type = "date";
        element2.name = "bill[" + rowCount + "][date]";
        element2.required = "true";
        element2.style = "width:80%";
        element2.className = "form-control";
        cell2.appendChild(element2);


        var cell3 = row.insertCell(2);
        var element3 = document.createElement("input");
        element3.type = "time";
        element3.name = "bill[" + rowCount + "][from_timing]";
        element3.style = "width:80%";
        element3.className = "form-control";
        cell3.appendChild(element3);

        var cell4 = row.insertCell(3);
        var element4 = document.createElement("input");
        element4.type = "time";
        element4.name = "bill[" + rowCount + "][to_timing]";
        element4.style = "width:80%";
        element4.className = "form-control";
        cell4.appendChild(element4);
    }
</script>
<br><br>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add Appointments</h3>
                </div>
                <!-- /.card-header -->
                <?php
                if (validation_errors() != false) {
                    echo "<div class='alert alert-danger alert-dismissible' style='margin: 20px;'>";
                    echo "<i style='font-size: 24px;';><span class='fa fa-warning'></span> Required Fields</i>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                    echo validation_errors();
                    echo "</div>";
                }
                ?>
                <form class="form-horizontal" action="<?php echo base_url() ?>insert-appoint" method="post" accept-charset="utf-8">                    
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-3 col-xs-3 col-md-3">
                                <div class="form-group">
                                    <label for="selectevent" class="control-label">Select Event</label>
                                    <select class="form-control select2" name="selectevent" onchange="get_event_name(this.value);
                                            get_event_date(this.value);">
                                        <option value="">[select]</option>
                                        <?php
                                        $r1 = $this->admin_model->select_event();

                                        foreach ($r1 as $s1) {
                                            ?>
                                            <option value="<?php echo $s1->eventkey ?>" ><?php echo $s1->eventname ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-3 col-md-3">
                                <div class="form-group">
                                    <label for="edate" class="col-sm-4 control-label">Event Date</label>
                                    <input type="text" class="form-control" name="edate" value="" id="edate">
                                </div>
                            </div>
                            <input type="hidden" name="event_name" id="event_name">
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 col-md-12">
                                <table class="table table-bordered table-hover responsive" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="fee_table_bg">Select & Delete</th>
                                            <th class="fee_table_bg">Start date</th>
                                            <th class="fee_table_bg">Start-Time</th>
                                            <th class="fee_table_bg">End-Time</th>                                            
                                        </tr>
                                        <tr>
                                            <td colspan="4"><b>
                                                    <span class="pull-right">
                                                        <button type="button" class="btn btn-success" style="background-color: #00a65a!important;" onclick="addRow('table1')"><i class="fa fa-plus"></i></button>
                                                        <button type="button" class="btn btn-primary" onclick="deleteRow('table1')"><i class="fa fa-minus"></i></button>
                                                    </span>

                                                    <!--<INPUT type="button" value="-" onclick="deleteRow('table1')" /></b>-->
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody style="height:250px; overflow:scroll">

                                    </tbody>
                                </table>                                
                                <input type="submit" class="btn btn-success"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
$this->load->view('head_foot/footer');
?>