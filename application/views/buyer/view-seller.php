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
?>

<br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<section class="content">
    <div class="container">
        <!-- Horizontal Form -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">View Seller of <?php echo $r2->eventname ?></h3>
            </div>
            <div class="row" style="margin-right: 0px; margin-left: 0px;">
                <div class="col-md-12">
                    <table id="example1" class="table table-striped ">
                        <tbody id='his'>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Email Id</th>
                                <th>Event</th>
                                <th>Comp</th>
                                <th>Seller</th>
                                <th>Booking</th>
                            </tr>
                            <?php
                            $i = 1;
                            $result = $this->buyer_model->select_sellers($r2->selectevent);
                            foreach ($result as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $row->name ?></td>
                                    <td><?php echo $row->email ?></td>
                                    <td><?php
                                        $a1 = $this->admin_model->get_event_name($row->selectevent);
                                        foreach ($a1 as $a2) {
                                            
                                        }
                                        echo $a2->eventname;
                                        ?></td>
                                    <td><?php echo $row->company ?></td>
                                    <td><?php echo $row->sel_type ?></td>
                                    
                                    <td><a style="line-height: 0.5;background: red; color: white; border: red;" href="<?php echo base_url(); ?>Buyers_login/booking/<?php echo $row->refno_gen ?>" class="btn btn-warning">Book</a></td>
                                </tr>
                                <?php
                                $i += 1;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>