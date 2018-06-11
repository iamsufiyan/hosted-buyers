<?php
$this->load->view('head_foot/header');
?>

<br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    function count_days(val) {
<?php $base = base_url(); ?>
        var url = "<?php echo"$base"; ?>index.php/Admin_registration/count_days/" + val;
        $.ajax({
            type: 'post',
            url: url,
            success: function (response) {
                document.getElementById("nod").value = response;
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
    function get_outward_data(id) {
        var base_url = "<?php echo base_url(); ?>";
        var base_url_two = "index.php/Admin_registration/edit_event/" + id;
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
<form role="form" action="<?php echo base_url(); ?>index.php/Admin_registration/updateevent" method="post">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17a2b8!important; color: white!important;">
                    <h4 class="modal-title">Edit Events</h4>
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
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add Events</h3>
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
                    <form class="form-horizontal" action="<?php echo base_url() ?>insert-event" method="post" accept-charset="utf-8">                    
                        <div class="card-body">
                            <div class="form-group">
                                <label for="eventname" class="col-sm-4 control-label">Event Name</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="eventname" value="<?php echo set_value('eventname') ?>" id="eventname" placeholder="Enter Event Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shortname" class="col-sm-4 control-label">Short Name</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="shortname"  value="<?php echo set_value('shortname') ?>" id="shortname" placeholder="Enter Short Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="eventkey"   class="col-sm-4 control-label">Event Key</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="eventkey" value="<?php echo set_value('eventkey') ?>" id="eventkey" placeholder="Enter Event Key">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sed" class="col-sm-4 control-label">Select Event Date </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="reservation" name="sed" value="<?php echo set_value('sed') ?>" onchange="count_days(this.value)">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="nod" class="col-sm-4 control-label">No of days</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nod" value="<?php echo set_value('nod') ?>" id="nod">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description"   class="col-sm-4 control-label">Description</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description"  id="eventkey"><?php echo set_value('description') ?></textarea>
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
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header" style="background-color: #17a2b8!important;color:white!important;">
                        <h3 class="card-title">List Events</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <tbody><tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Short code</th>
                                    <th>Event key</th>
                                    <th>Event date</th>
                                    <th>Total Days</th>
                                    <th style="width: 40px">Edit</th>
                                    <th style="width: 40px">Delete</th>
                                </tr>
                                <?php
                                $i = 1;
                                $result = $this->admin_model->select_event();
                                foreach ($result as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row->eventname ?></td>
                                        <td><?php echo $row->shortname ?></td>
                                        <td><?php echo $row->eventkey ?></td>
                                        <td><?php echo $row->event_date ?></td>
                                        <td><?php echo $row->no_of_days ?></td>
                                        <?php
                                        echo" <td><div><a href='' class='fa fa-edit' style='color:blue!important' data-toggle='modal' onclick='get_outward_data($row->id);' data-target='#myModal'></a>&nbsp;&nbsp;"
                                        ;
                                        ?>
                                        <!--<td><i class="nav-icon fa fa-edit"></i></td>-->
                                        <td><a href="<?php echo base_url() ?>index.php/Admin_registration/delete_event/<?php echo $row->id ?>" onclick="return confirm('Are you sure you want to delete event?')"><i class="nav-icon fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php
                                    $i += 1;
                                }
                                ?>
                            </tbody></table>
                        <!-- Modal -->

                    </div>
                    <!-- /.card-body -->



                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<?php $this->load->view('head_foot/footer'); ?>


