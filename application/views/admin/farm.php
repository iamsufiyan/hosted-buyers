<?php $this->load->view('head_foot/header'); ?>
<style>
    .card-info:not(.card-outline) .card-header {
        background-color: #28588a!important;
        border: 1px solid #28588a;
        color: white!important;
    }
    table th, table td{
        text-align: center;
    } 
</style>
<br><br>
<section class="content">
    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Farm Trip <div class="float-right"><a style="border-color: #ffffff;background: white;color: black;" href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New</a></div></h3>

            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12" style="padding-right: 25px; padding-left: 25px;">

                    <table class="table table-bordered" id="mydata">
                        <thead>
                            <tr>
                                <th>Select Event</th>
                                <th>Farm Code</th>
                                <th>Farm Name</th>
                                <th>No of Peoples</th>
                                <th>Description</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- MODAL ADD -->
<form>
    <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Farm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Event</label>
                        <div class="col-md-10">
                            <select class="form-control select2" name="selectevent" id="selectevent" onchange="get_event_name(this.value);">
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
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Farm Code</label>
                        <div class="col-md-10">
                            <input type="text" name="farm_code" id="farm_code" class="form-control" placeholder="Enter Farm Code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Farm Name</label>
                        <div class="col-md-10">
                            <input type="text" name="farm_name" id="farm_name" class="form-control" placeholder="Farm Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Max Registration</label>
                        <div class="col-md-10">
                            <input type="text" name="max_reg" id="max_reg" class="form-control" placeholder="Enter Max Registration">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Description</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--END MODAL ADD-->

<!-- MODAL EDIT -->
<form>
    <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Farm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Event</label>
                        <div class="col-md-10">
                            <select class="form-control select2" name="selectevent_edit" id="selectevent_edit" onchange="get_event_name(this.value);">
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
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Farm Code</label>
                        <div class="col-md-10">
                            <input type="text" name="farm_code_edit" id="farm_code_edit" class="form-control" placeholder="Farm Code" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Farm Name</label>
                        <div class="col-md-10">
                            <input type="text" name="farm_name_edit" id="farm_name_edit" class="form-control" placeholder="Farm Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Max Registration</label>
                        <div class="col-md-10">
                            <input type="text" name="max_reg_edit" id="max_reg_edit" class="form-control" placeholder="Max People">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Description</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="description_edit" id="description_edit"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--END MODAL EDIT-->
<!--MODAL DELETE-->
<form>
    <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Farm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="farm_code" id="product_code_delete" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--END MODAL DELETE-->
<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/bootstrap/js/bootstrap.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap4.min' ?>"></script>
<script type="text/javascript">
                                $(document).ready(function () {
                                    show_product(); //call function show all product

                                    $('#mydata').dataTable();

                                    //function show all product
                                    function show_product() {
                                        $.ajax({
                                            type: 'ajax',
                                            url: '<?php echo site_url('Admin_registration/product_data') ?>',
                                            async: false,
                                            dataType: 'json',
                                            success: function (data) {
                                                var html = '';
                                                var i;
                                                for (i = 0; i < data.length; i++) {
                                                    html += '<tr>' +
                                                            '<td>' + data[i].selectevent + '</td>' +
                                                            '<td>' + data[i].farm_code + '</td>' +
                                                            '<td>' + data[i].farm_name + '</td>' +
                                                            '<td>' + data[i].max_reg + '</td>' +
                                                            '<td>' + data[i].description + '</td>' +
                                                            '<td style="text-align:center;">' +
                                                            '<a href="javascript:void(0);" class="item_edit" data-selectevent="' + data[i].selectevent + '" data-farm_code="' + data[i].farm_code + '" data-farm_name="' + data[i].farm_name + '" data-max_reg="' + data[i].max_reg + '" data-description="' + data[i].description + '"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;' + ' ' +
                                                            '<a href="javascript:void(0);" class="item_delete" style="color:red" data-farm_code="' + data[i].farm_code + '"><i class="fa fa-trash"></span></i></a>' +
                                                            '</td>' +
                                                            '</tr>';
                                                }
                                                $('#show_data').html(html);
                                            }

                                        });
                                    }

                                    //Save product
                                    $('#btn_save').on('click', function () {
                                        var selectevent = $('#selectevent').val();
                                        var farm_code = $('#farm_code').val();
                                        var farm_name = $('#farm_name').val();
                                        var max_reg = $('#max_reg').val();
                                        var description = $('#description').val();
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo site_url('Admin_registration/save') ?>",
                                            dataType: "JSON",
                                            data: {selectevent: selectevent, farm_code: farm_code, farm_name: farm_name, max_reg: max_reg, description: description},
                                            success: function (data) {
                                                $('[name="selectevent"]').val("");
                                                $('[name="farm_code"]').val("");
                                                $('[name="farm_name"]').val("");
                                                $('[name="max_reg"]').val("");
                                                $('[name="description"]').val("");
                                                $('#Modal_Add').modal('hide');
                                                show_product();
                                            }
                                        });
                                        return false;
                                    });

                                    //get data for update record
                                    $('#show_data').on('click', '.item_edit', function () {                                    
                                        var selectevent = $(this).data('selectevent');
                                        var farm_code = $(this).data('farm_code');
                                        var farm_name = $(this).data('farm_name');
                                        var max_reg = $(this).data('max_reg');
                                        var description = $(this).data('description');

                                        $('#Modal_Edit').modal('show');
                                        $('[name="selectevent_edit"]').val(selectevent);
                                        $('[name="farm_code_edit"]').val(farm_code);
                                        $('[name="farm_name_edit"]').val(farm_name);
                                        $('[name="max_reg_edit"]').val(max_reg);
                                        $('[name="description_edit"]').val(description);
                                    });

                                    //update record to database
                                    $('#btn_update').on('click', function () {
                                         var selectevent = $('#selectevent_edit').val();
                                        var farm_code = $('#farm_code_edit').val();
                                        var farm_name = $('#farm_name_edit').val();
                                        var max_reg = $('#max_reg_edit').val();
                                        var description = $('#description_edit').val();
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo site_url('Admin_registration/update') ?>",
                                            dataType: "JSON",
                                            data: {selectevent: selectevent, farm_code: farm_code, farm_name: farm_name, max_reg: max_reg, description: description},
                                            success: function (data) {
                                                $('[name="selectevent_edit"]').val("");
                                                $('[name="farm_code_edit"]').val("");
                                                $('[name="farm_name_edit"]').val("");
                                                $('[name="max_reg_edit"]').val("");
                                                $('[name="description_edit"]').val("");
                                                $('#Modal_Edit').modal('hide');
                                                show_product();
                                            }
                                        });
                                        return false;
                                    });

                                    //get data for delete record
                                    $('#show_data').on('click', '.item_delete', function () {
                                        var farm_code = $(this).data('farm_code');
                                        $('#Modal_Delete').modal('show');
                                        $('[name="farm_code"]').val(farm_code);
                                    });

                                    //delete record to database
                                    $('#btn_delete').on('click', function () {
                                        var farm_code = $('#farm_code').val();
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo site_url('Admin_registration/delete') ?>",
                                            dataType: "JSON",
                                            data: {farm_code: farm_code},
                                            success: function (data) {
                                                $('[name="farm_code"]').val("");
                                                $('#Modal_Delete').modal('hide');
                                                show_product();
                                            }
                                        });
                                        return false;
                                    });

                                });
</script>