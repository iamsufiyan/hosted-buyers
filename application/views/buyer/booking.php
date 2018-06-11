<?php
$this->load->view('head_foot/header-buyer');
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
    $regno = ($this->session->userdata['logged_in']['regno']);
    $refno_gen = ($this->session->userdata['logged_in']['refno_gen']);
}

$r1 = $this->buyer_model->select_uniq_event($refno_gen);
foreach ($r1 as $r2) {
    
}
$timing = "$from-$to";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<br>
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
    <div class="container">
        <!-- Horizontal Form -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Booking <?php echo $r2->eventname ?></h3>
            </div>
            <hr>
            
            <form role="form" action="<?php echo base_url() ?>confirm-booking" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="row" style="margin-right: 0px; margin-left: 0px;">
                    <input type="hidden" name="from_time" value="<?php echo $from ?>">
                    <input type="hidden" name="to_time" value="<?php echo $to ?>">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title" class="col-sm-6 control-label">Select Seller</label>
                            <select name="seller" class="select2 form-control" required>
                                <option>[Select Seller]</option>
                                <?php
                                $result = $this->buyer_model->select_sell($r2->selectevent);
                                foreach ($result as $row) {
                                    echo "<option value='$row->refno_gen'>$row->name</option>";
                                }
                                ?> 
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="app_event_date" class="col-sm-12 control-label">Appointment-Date</label>
                            <input readonly class="form-control" type="text" name="app_event_date" id="app_event_date" value="<?php echo $date ?>"> 
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="timing" class="col-sm-6 control-label">Time</label>
                            <input readonly class="form-control" type="text" name="time" id="name" value="<?php echo $timing ?>"> 
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="event_key" class="col-sm-6 control-label">Event-key</label>
                            <input readonly class="form-control" type="text" name="event_key" id="event_key" value="<?php echo $event_key ?>"> 
                        </div>
                    </div>
                    <div class="col-md-3" style="display: none">
                        <div class="form-group">
                            <label for="username" class="col-sm-6 control-label">Buyer Name</label>
                            <input readonly class="form-control" type="hidden" name="bname" id="bname" value="<?php echo $username ?>"> 
                        </div>
                    </div>
                    <div class="col-md-3" style="display: none">
                        <div class="form-group">
                            <label for="refno" class="col-sm-6 control-label">Refno</label>
                            <input readonly class="form-control" type="hidden" name="refno" id="refno" value="<?php echo $refno_gen ?>"> 
                        </div>
                    </div>
                    <div class="col-md-2" style="margin-top: 31px">
                        <input type="submit" class="btn btn-info" value="Book"/>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</section>
<?php
$this->load->view('head_foot/footer');
?>