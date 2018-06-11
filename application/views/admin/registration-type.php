<?php
$this->load->view('head_foot/header');
?>

<br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-6">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add Admin</h3>
                    </div>
                    <!-- /.card-header -->

                    <form class="form-horizontal" action="<?php echo base_url() ?>index.php/Admin_registration/register_type" method="post" accept-charset="utf-8">                    
                        <div class="card-body">
                            <div class="form-group">
                                <label for="uniqno" class="col-sm-4 control-label">Add Registration</label>
                                <?php
                                $list = $this->admin_model->select_acc_code();
                                foreach ($list as $rows) {
                                    $codes = $rows->uniqno;
                                }
                                if (empty($codes)) {
                                    $class_code = 100;
                                    ?>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="uniqno" value="<?php echo $class_code ?>" id="uniqno" placeholder="Enter Register Type" readonly>
                                    </div>                                    
                                    <?php
                                } else {
                                    $start_code = $codes + 1;
                                    ?>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="uniqno" value="<?php echo $start_code ?>" id="uniqno" placeholder="Enter Register Type" readonly>
                                    </div> 
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="regtype" class="col-sm-4 control-label">Registration Type</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="regtype" value="<?php echo set_value('regtype') ?>" id="regtype" placeholder="Enter Register Type">
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
            <div class="col-md-6">
                <div class="card">

                    <div class="card-header" style="background-color: #17a2b8!important;color:white!important;">
                        <h3 class="card-title">List Registration</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <tbody><tr>
                                    <th style="width: 10px">#</th>
                                    <th>Unique No</th>
                                    <th>Register Type</th>
                                    <th>Delete</th>
                                </tr>
                                <?php
                                $i = 1;
                                $result = $this->admin_model->select_registration();
                                foreach ($result as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row->uniqno ?></td>
                                        <td><?php echo $row->reg_type ?></td>
                                        <td><a href="<?php echo base_url() ?>index.php/Admin_registration/delete_reg/<?php echo $row->id ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="nav-icon fa fa-trash"></i></a></td>
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


