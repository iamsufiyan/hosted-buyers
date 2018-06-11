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
<br><br>
<section class="content">
    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Farm Trip <?php echo $r2->eventname ?></h3>
            </div>
            <hr>
        </div>
        <div class="row">
            
            <table class="table responsive table-hover">
                <tr>
                    <th>Sino</th>
                    <th>Event</th>
                    <th>Farm Code</th>
                    <th>Farm Name</th>
                    <th>Reg Available</th>
                    <th>Book</th>
                </tr>
                <?php
                $i = 1;
                $result = $this->buyer_model->select_farm($r2->selectevent);
                foreach ($result as $row) {
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row->selectevent ?></td>
                        <td><?php echo $row->farm_code ?></td>
                        <td><?php echo $row->farm_name ?></td>
                        <td><?php echo $row->max_available ?></td>
                        <td><a class="btn btn-dark" href="<?php echo base_url(); ?>Buyers_login/booking_farm/<?php echo $refno_gen ?>/<?php echo $row->refno_gen ?>/<?php echo $row->max_available ?>">Apply</a></td>
                    </tr>
                    <?php
                    $i += 1;
                }
                ?>
            </table>
        </div>
    </div>
</section>
<?php
$this->load->view('head_foot/footer');
?>