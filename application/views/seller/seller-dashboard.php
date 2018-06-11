
<?php
$this->load->view('head_foot/header-seller');
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
    $refno_gen = ($this->session->userdata['logged_in']['refno_gen']);
}
//echo "$username<br>$email<br>$refno_gen<br>";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    .table th, .table td {
        text-align:center;   
    }
</style>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><h1 class="m-0 text-dark">Welcome <?php echo $username ?></h1></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">    
            <div class="col-12 col-sm-6 col-md-12">
                <table class="table table-hover table-inverse responsive">
                    <tr>
                        <th>SI No</th>
                        <th>Buyer Name</th>
                        <th>Event</th>
                        <th>Timing</th>
                        <th>Appointment Date</th>   
                        <th>Action</th> 
                        <th>View Details</th> 
                    </tr>

                    <?php
                    $i = 1;
                    $result = $this->seller_model->get_requester($refno_gen);
                    foreach ($result as $row) {
                        $from = DateTime::createFromFormat('Y-m-d', $row->app_event_date)->format('d-m-Y');
                        ?><tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row->buyer_name ?></td>
                            <td><?php echo $row->eventname ?></td>
                            <td><?php echo $row->time ?></td>
                            <td><?php echo $from ?></td>
                            <td> 
                                <?php
                                if ($row->bit == 0) {
                                    ?>
                                    <a href="<?php echo base_url(); ?>Sellers_login/final_booked/<?php echo $row->unique_id ?>"><i class="fa fa-check" style="font-size: 21px; color: white; background: #029c25; padding: 5px 23px 5px 23px; border-radius: 8px 8px 8px 8px;"></i></a>
                                    &nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>Sellers_login/final_reject/<?php echo $row->unique_id ?>"><i class="fa fa-close" style="font-size: 21px; color: white; background: #dc3545; padding: 5px 23px 5px 23px; border-radius: 8px 8px 8px 8px;"></i></a>
                                        <?php
                                    } elseif ($row->bit == 2) {
                                        echo "<span style='color: white; background: red; padding: 4px 16px 4px 16px; border-radius: 3px 15px 3px 15px;'>Rejected</span>";
                                    } else {
                                        echo "<span style='color: white; background: green; padding: 4px 16px 4px 16px; border-radius: 3px 15px 3px 15px;'>Accepted</span>";
                                    }
                                    ?>
                            </td>
                            <td><a href="<?php echo base_url(); ?>Sellers_login/view_buyer/<?php echo $row->refno_gen ?>"><span style='color: white; background: #5668a9; padding: 4px 16px 4px 16px; border-radius: 5px;'>View</span></a></td>
                        </tr>
                        <?php
                        $i += 1;
                    }
                    ?>

                </table>
            </div>
        </div>
    </div>
</section>

<?php
$this->load->view('head_foot/footer');
?>