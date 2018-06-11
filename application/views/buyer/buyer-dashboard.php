
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
$count = 10;
?>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard <?php echo $r2->selectevent ?></h1>
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
            <?php
            $list3 = $this->buyer_model->count_seller($r2->selectevent);
            foreach ($list3 as $tot2) {
                
            }
            ?>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="<?php echo base_url(); ?>view-sellers">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-user"></i></span>

                        <div class="info-box-content">
                            <b><span class="info-box-text" style="color:black"><?php echo $r2->eventname ?><br>Seller's</span></b>
                            <span class="info-box-number"><?php echo $tot2->count ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            $list4 = $this->buyer_model->count_reject($refno_gen);
            foreach ($list4 as $tot3) {
                
            }
            ?>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-close"></i></span>

                        <div class="info-box-content">
                            <b><span class="info-box-text" style="color:black">Sellers Rejected <br> (<?php echo $username ?>)</span></b>
                            <span class="info-box-number"><?php echo $tot3->count ?></span>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            $list5 = $this->buyer_model->count_accept($refno_gen);
            foreach ($list5 as $tot4) {
                
            }
            ?>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-check"></i></span>

                        <div class="info-box-content">
                            <b><span class="info-box-text" style="color:black">Seller Accepted <br> (<?php echo $username ?>)</span></b>
                            <span class="info-box-number"><?php echo $tot4->count ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            $list6 = $this->buyer_model->count_up($refno_gen);
            foreach ($list6 as $tot5) {
                
            }
            ?>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-purple elevation-1"><i class="fa fa-product-hunt"></i></span>

                        <div class="info-box-content">
                            <b><span class="info-box-text" style="color:black">Request Under Process  <br> (<?php echo $username ?>)</span></b>
                            <span class="info-box-number"><?php echo $tot5->count ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            $list8 = $this->buyer_model->count_farm_trip($r2->selectevent);
            foreach ($list8 as $tot8) {                
            }
            ?>
            <?php
            $a1 = $this->buyer_model->check_booking($refno_gen);
            foreach ($a1 as $a2) {
                
            }
            if ($a2->buyer_refno == '') {
                ?>
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="<?php echo base_url(); ?>view-farm">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-calendar"></i></span>

                            <div class="info-box-content">
                                <b><span class="info-box-text" style="color:black">Farm Trip</span></b>
                                <span class="info-box-number"><?php echo $tot8->count ?></span>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            } else {
                ?>
                <?php
            }
            ?>
            <?php
            if ($a2->buyer_refno == '') {
                ?>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                        Please Book The Farm Trip
                    </div>
                </div>
                <?php
            }else{
                ?>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fa fa-check"></i> Alert!</h5>
                        Thank You For Booking of Farm Trip<br>
                        <a href="" class="btn btn-default" style="background-color: #23923d;text-decoration: none">View Farm</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <style>
            .table td, .table th {
                border-top: 1px solid #c6ccd2;
                background: white;
            }
        </style>

        <div class="row">
            <div class="col-md-6">
                <table class="table responsive table-hover">
                    <tr>
                        <th style="border-top: 1px solid white;"><i class="fa fa-home fa-2x" style="color: green"></i><br>Available</th>
                        <th style="border-top: 1px solid white;"><i class="fa fa-paper-plane fa-2x" style="color: purple"></i><br>Request</th>
                        <th style="border-top: 1px solid white;"><i class="fa fa-book fa-2x" style="color: red"></i><br>Booked</th>
                    </tr>
                </table>
            </div>
        </div>
        <h3 style="text-align: center;background: #143e5d;color: white;padding: 2px 0px 3px 0px;border-radius: 5px;">Booking</h3>
        <div class="row">
            <div class="col-md-12">
                <table class="responsive table-hover table" style="background-color: white; border: 1px solid #c6ccd2">

                    <?php
                    $s = 1;
                    $result = $this->buyer_model->get_slots($r2->selectevent);
                    foreach ($result as $row) {
                        $from = DateTime::createFromFormat('Y-m-d', $row->schedule_date)->format('d-m-Y');
                        if ($s == 1) {
                            echo"<tr>";
                        }
                        ?>
                        <?php
                        if ($row->status == '') {
                            ?> 
                            <td style="text-align: center">
                                <a style="color:black" href="<?php echo base_url(); ?>Buyers_login/booking/<?php echo $row->from_timing ?>/<?php echo $row->to_timing ?>/<?php echo $row->event_key ?>/<?php echo $row->schedule_date ?>">
                                    <i class="fa fa-home fa-2x" style="color: green"></i><br>
                                    <p style="font-family: 'Roboto', sans-serif;"><?php echo $row->from_timing ?> : <?php echo $row->to_timing ?> <br> <?php echo $from ?></p>

                                </a>
                            </td>
                            <?php
                        } elseif ($row->status == 'Booked') {
                            ?>
                            <td style="text-align: center">
                                <i class="fa fa-book fa-2x" style="color: red"></i><br>
                                <p style="font-family: 'Roboto', sans-serif;"><?php echo $row->from_timing ?> : <?php echo $row->to_timing ?> <br> <?php echo $from ?></p>
                            </td>
                            <?php
                        } else {
                            ?>
                            <td style="text-align: center">
                                <i class="fa fa-paper-plane fa-2x" style="color: purple"></i><br>
                                <p style="font-family: 'Roboto', sans-serif;"><?php echo $row->from_timing ?> : <?php echo $row->to_timing ?> <br> <?php echo $from ?></p>
                            </td>
                            <?php
                        }
                        if ($s == $count) {
                            echo"</tr>";
                            $s = 0;
                        }
                        $s = $s + 1;
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