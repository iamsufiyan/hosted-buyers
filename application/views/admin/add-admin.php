<?php
$this->load->view('head_foot/header');
?>

<br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
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
        var base_url_two = "index.php/Admin_registration/edit_admin/" + id;
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
<style>
    .red{
        font-size: 20px!important;
    }
    .select2-selection__arrow{display: none;}
    #files { font-family: Verdana, sans-serif; font-size: 11px; }
    #files strong { font-size: 13px; }
    #files a { float: right; margin: 0 0 5px 10px; }
    #files ul { list-style: none; padding-left: 0; }
    #files li { width: 280px; font-size: 12px; padding: 5px 0; border-bottom: 1px solid #CCC; }
</style>
<?php
if (validation_errors() != false) {
    echo "<div class='alert alert-danger alert-dismissible' style='margin: 20px;'>";
    echo "<i style='font-size: 24px;';><span class='fa fa-warning'></span> Required Fields</i>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo validation_errors();
    echo "</div>";
}
?>
<form role="form" action="<?php echo base_url(); ?>index.php/Admin_registration/updateadmin" method="post">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17a2b8!important; color: white!important;">
                    <h4 class="modal-title">Edit Admin User</h4>
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
        <div class="row">
            <div class="col-md-4">                
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add Admin</h3>
                    </div>
                    <!-- /.card-header -->

                    <form class="form-horizontal" action="<?php echo base_url() ?>insert-admin" method="post" accept-charset="utf-8">                    
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username" class="col-sm-4 control-label">Username</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" value="<?php echo set_value('username') ?>" id="username" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email"  value="<?php echo set_value('email') ?>" id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3"   value="<?php echo set_value('password') ?>" class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" value="<?php echo set_value('password') ?>" id="inputPassword3" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="submit" class="btn btn-default float-right">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: #17a2b8!important;color:white!important;">
                        <h3 class="card-title">List Admin User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped table-responsive">
                            <tbody><tr>
                                    <th style="width: 10px">#</th>
                                    <th>User Name</th>
                                    <th>Email Id</th>
                                    <th>Creted on</th>
                                    <th style="width: 40px">Edit</th>
                                    <th style="width: 40px">Delete</th>
                                </tr>
                                <?php
                                $i = 1;
                                $result = $this->admin_model->select_admin();
                                foreach ($result as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row->username ?></td>
                                        <td><?php echo $row->email ?></td>
                                        <td><?php echo $row->date ?></td>
                                        <?php
                                        echo" <td><div><a href='' class='fa fa-edit' style='color:red!important' data-toggle='modal' onclick='get_outward_data($row->id);' data-target='#myModal'></a>&nbsp;&nbsp;"
                                        ;
                                        ?>
                                        <!--<td><i class="nav-icon fa fa-edit"></i></td>-->
                                        <td><a href="<?php echo base_url() ?>index.php/Admin_registration/delete_admin/<?php echo $row->id ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="nav-icon fa fa-trash"></i></a></td>
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
</section>
<?php $this->load->view('head_foot/footer'); ?>


