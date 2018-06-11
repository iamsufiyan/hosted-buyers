<?php
$this->load->view('head_foot/header');
?>
<style>
    .card-header {
        position: relative;
        background-color: transparent;
        border-bottom: 1px solid rgb(255, 255, 255)!important;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    function get_event_csv(val) {
<?php $base = base_url(); ?>
        var url = "<?php echo"$base"; ?>index.php/Admin_registration/get_event_csv/" + val;
        $.ajax({
            type: 'post',
            url: url,
            success: function (response) {
                document.getElementById("change").innerHTML = response;
            }
        });
    }
    function get_event_filter(val) {
<?php $base = base_url(); ?>
        var url = "<?php echo"$base"; ?>index.php/Admin_registration/get_event_filter/" + val;
        $.ajax({
            type: 'post',
            url: url,
            success: function (response) {
                document.getElementById("his").innerHTML = response;
            }
        });
    }

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
    function get_filter(val) {
        var event = document.getElementById('get_event').value;
<?php $base = base_url(); ?>
        var url = "<?php echo"$base"; ?>index.php/Admin_registration/get_filter/" + event + '/' + val;
        $.ajax({
            type: 'post',
            url: url,
            success: function (response) {
                document.getElementById("his").innerHTML = response;
            }
        });
    }
    function get_event_type_csv(val) {
        var event = document.getElementById('get_event').value;
<?php $base = base_url(); ?>
        var url = "<?php echo"$base"; ?>index.php/Admin_registration/get_event_type_csv/" + event + '/' + val;
        $.ajax({
            type: 'post',
            url: url,
            success: function (response) {
                document.getElementById("change").innerHTML = response;
            }
        });
    }
    function get_reg_type(val) {
<?php $base = base_url(); ?>
        var url = "<?php echo"$base"; ?>index.php/Admin_registration/get_reg_type/" + val;
        $.ajax({
            type: 'post',
            url: url,
            success: function (response) {
                document.getElementById("reg_type").innerHTML = response;
            }
        });
    }

    function getXMLHTTP() { //fuction to return the xml http object
        var xmlhttp = false;
        try {
            xmlhttp = new XMLHttpRequest();
        } catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e1) {
                    xmlhttp = false;
                }
            }
        }

        return xmlhttp;
    }
    function get_outwards_data(id) {
        var base_url = "<?php echo base_url(); ?>";
        var base_url_two = "index.php/Admin_registration/gen_buyer_password/" + id;
        var strURL = base_url + base_url_two;
        var req = getXMLHTTP();
        if (req) {

            req.onreadystatechange = function () {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        document.getElementById('doc_info1').innerHTML = req.responseText;
                        //alert('iam here');
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("POST", strURL, true);
            req.send(null);
        }
    }
    function get_outward_data(id) {
        var base_url = "<?php echo base_url(); ?>";
        var base_url_two = "index.php/Admin_registration/edit_buyer/" + id;
        var strURL = base_url + base_url_two;
        var req = getXMLHTTP();
        if (req) {

            req.onreadystatechange = function () {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        document.getElementById('doc_info').innerHTML = req.responseText;
                        //alert('iam here');
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("POST", strURL, true);
            req.send(null);
        }
    }

</script>
<script>
    function get_reg_fun(val) {
<?php $base = base_url(); ?>
        var url = "<?php echo"$base"; ?>index.php/Admin_registration/get_reg/" + val;
        $.ajax({
            type: 'post',
            url: url,
            success: function (response) {
                document.getElementById("get_reg").value = response;
            }
        });
    }
</script>
<form role="form" action="<?php echo base_url(); ?>update-buyer" method="post">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17a2b8!important; color: white!important;">
                    <h4 class="modal-title">Edit Buyer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="doc_info">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form role="form" action="<?php echo base_url(); ?>update-buyer-password" method="post">
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header"  style="background-color: #17a2b8!important; color: white!important;">
                    <h5 class="modal-title" id="exampleModalLongTitle">Generate Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="doc_info1">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" style="background-color: #17a2b8!important; color: #ffffff!important;" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-3">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add Buyers</h3>
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
                    <form class="form-horizontal" action="<?php echo base_url() ?>insert-buyer" method="post" accept-charset="utf-8">                    
                        <div class="card-body">
                            <div class="form-group">
                                <label for="selectevent" class="col-sm-6 control-label">Select Event</label>

                                <div class="col-sm-10">
                                    <select class="form-control select2" name="selectevent" onchange="get_event_name(this.value);">
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
                            <input type="hidden" name="event_name" id="event_name">

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-6 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" value="<?php echo set_value('email') ?>" id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_type" class="col-sm-6 control-label">Registration Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="reg_type" onchange="get_reg_fun(this.value);">
                                        <option value="">[select]</option>
                                        <?php
                                        $r2 = $this->admin_model->select_registration();
                                        foreach ($r2 as $s2) {
                                            ?>
                                            <option value="<?php echo $s2->uniqno ?>" ><?php echo $s2->reg_type ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="get_reg" id="get_reg">
                            <div class="form-group">
                                <label for="regno" class="col-sm-6 control-label">Registration No</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="regno" value="<?php echo set_value('regno') ?>" id="regno" placeholder="Enter Registration Number">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-6 control-label">Title</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="title">                                        
                                        <option value="">[select]</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Mrs">Mrs</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-6 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="<?php echo set_value('name') ?>" id="name" placeholder="Enter Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="company" class="col-sm-6 control-label">Company</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company" value="<?php echo set_value('company') ?>" id="company" placeholder="Enter Company Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="telephone" class="col-sm-6 control-label">Telephone</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="telephone" value="<?php echo set_value('telephone') ?>" id="telephone" placeholder="Enter Telephone No">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="country" class="col-sm-6 control-label">Select Country</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="country">           
                                        <?php
                                        $d1 = $this->admin_model->get_country();
                                        foreach ($d1 as $d2) {
                                            ?>
                                            <option value='<?php echo $d2->code ?>' ><?php echo $d2->name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="addr1" class="col-sm-6 control-label">Address Line 1</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" name="addr1" id="addr1"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="addr2" class="col-sm-6 control-label">Address Line 2</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" name="addr2" id="addr2"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-sm-6 control-label">City</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="city" value="<?php echo set_value('city') ?>" id="city" placeholder="Enter City">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pcode" class="col-sm-6 control-label">Postal Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pcode" value="<?php echo set_value('pcode') ?>" id="pcode" placeholder="Enter Postal Code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="processingfee" class="col-sm-6 control-label">Processing Fee</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="processingfee" value="<?php echo set_value('processingfee') ?>" id="processingfee" placeholder="Enter Processing Fee">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rdeposit" class="col-sm-6 control-label">Refundable Deposit</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="rdeposit" value="<?php echo set_value('rdeposit') ?>" id="rdeposit" placeholder="Enter Refundable Deposit">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">

                    <div class="card-header col-sm-12" style="background-color: #17a2b8!important;color:white!important;">
                        <h3 class="card-title ">List Buyers </h3>                        
                    </div>
                    <div class="row">
                        <div class="card-header col-sm-6" style="background-color: #ffffff!important; color: #1f1d1d!important;">
                            <form action="<?php echo base_url(); ?>index.php/uploadcsv/import" 
                                  method="post" name="upload_excel" enctype="multipart/form-data">
                                <input type="file" name="file" id="file">
                                <button style="background-color: #17a2b8!important; color: #ffffff!important;" type="submit" class="btn btn-info" style="background-color: #ffffff!important; color: #1f1d1d!important;" id="submit" name="import">Import</button>&nbsp;&nbsp;<span id="change"><a  href="<?php echo base_url() ?>index.php/Admin_registration/buyers_csv"  class="btn btn-info">Export To CSV</a> &nbsp;</span>                     
                            </form>                     
                        </div>

                        <div class="card-header col-sm-3" style="background-color: #ffffff!important; color: #1f1d1d!important;">
                            <select class='form-control select2' name='get_event' id='get_event' onchange='get_reg_type(this.value);get_event_filter(this.value);get_event_csv(this.value);'>
                                <option value="">[Select-Event]</option>
                                <?php
                                $f1 = $this->admin_model->select_event();
                                foreach ($f1 as $f2) {
                                    ?>
                                    <option value="<?php echo $f2->eventkey ?>" ><?php echo $f2->eventname ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="card-header col-sm-3" style="background-color: #ffffff!important; color: #1f1d1d!important;">
                            <select class="form-control select2" name="reg_type" id='reg_type' onchange="get_filter(this.value);get_event_type_csv(this.value);">
                                <option value="">[Select Register Type]</option>
                            </select>
                        </div>
                    </div>                    
                    <div class="card-body p-0">
                        <form  role="form" action="<?php echo base_url(); ?>index.php/Admin_registration/deletebuyer" method="post">
                            <table class="table table-striped">
                                <tbody id='his'>
                                    <tr>
                                        <th>All<br><input type="checkbox" id="checkAl"></th>
                                        <th style="width: 10px">#</th>
                                        <th>Reg</th>
                                        <th>Name</th>
                                        <th>Event</th>
                                        <th>Comp</th>
                                        <th>Reg-type</th>
                                        <th>Trans Id</th>
                                        <th>Status</th>
                                        <th>Generate Pass</th>
                                        <th>Edit</th>
                                    </tr>
                                    <?php
                                    $i = 1;
                                    $result = $this->admin_model->select_buyers();
                                    foreach ($result as $row) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row->id; ?>"></td>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $row->regno ?></td>
                                            <td><?php echo $row->name ?></td>
                                            <td>
                                                <?php
                                                $a1 = $this->admin_model->get_event_name($row->selectevent);
                                                foreach ($a1 as $a2) {
                                                    
                                                }
                                                echo $a2->eventname;
                                                ?>
                                            <td><?php echo $row->company ?></td>

                                            <td>
                                                <?php
                                                $c1 = $this->admin_model->get_reg_name($row->reg_type_no);
                                                foreach ($c1 as $c2) {
                                                    
                                                }
                                                echo $c2->reg_type;
                                                ?></td>
                                            <td><?php
                                                if ($row->trans_id == '') {
                                                    echo "Not Paid";
                                                } else {
                                                    echo "$row->trans_id";
                                                }
                                                ?></td>
                                            <td><?php
                                                if ($row->pay_status == '') {
                                                    echo "Not Paid";
                                                } else {
                                                    echo "$row->pay_status";
                                                }
                                                ?></td>
                                            <?php
                                            if ($row->password == '') {
                                                echo" <td><div><a href='' class='fa fa-lock fa-lg' style='color:red!important' data-toggle='modal' data-target='#exampleModalCenter' onclick='get_outwards_data($row->id);' data-target='#myModals'></a>&nbsp;&nbsp;"
                                                ;
                                            } else {
                                                echo" <td><div><a href='#' class='fa fa-check fa-lg' style='color:green!important'></a>&nbsp;&nbsp;"
                                                ;
                                            }
                                            ?>
                                            <?php
                                            echo" <td><div><a href='' class='fa fa-edit' style='color:blue!important' data-toggle='modal' onclick='get_outward_data($row->id);' data-target='#myModal'></a>&nbsp;&nbsp;"
                                            ;
                                            ?>


                                        </tr>
                                        <?php
                                        $i += 1;
                                    }
                                    ?>
                                </tbody></table>
                            <div class="card-header col-sm-12" style="background-color: white!important;color:white!important;">
                                <button style="background-color: #17a2b8!important;border:none; color: #ffffff!important;"  onclick="return confirm('Are you sure you want to delete?')"  type="submit" class="btn btn-success" name="save">Delete</button>
                            </div>
                        </form>
                        <script>
                            $("#checkAl").click(function () {
                                $('input:checkbox').not(this).prop('checked', this.checked);
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<?php $this->load->view('head_foot/footer'); ?>


