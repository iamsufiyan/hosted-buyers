<?php
$this->load->view('head_foot/header');
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
}
$result = $this->admin_model->select_appoint_key($key);
foreach ($result as $value) {
    
}
?>
<br><br>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header" style="background: white!important">
                    <b><h3 class="card-title" style="text-align:center;text-transform:uppercase;color: black!important"><?php echo $value->event_name ?> Timing Slot</h3></b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-md-12">
                            <table class="table table-bordered responsive">
                                <tr>
                                    <th>Sino</th>
                                    <th>Event Name</th>
                                    <th>Event Date</th>
                                    <th>Event Key</th>
                                    <th>Date</th>
                                    <th>Time Slot</th>
                                </tr>
                                <?php
                                $i = 1;
                                
                                foreach ($result as $row) {
                                    ?>
                                    <tr>
                                        <td>Sino</td>
                                        <td><?php echo $row->event_name ?></td>  
                                        <td><?php echo $row->total_event_date ?></td> 
                                        <td><?php echo $row->event_key ?></td> 
                                        <td>
                                            <?php
                                            $result1 = $this->admin_model->select_appoint_date($key);
                                            foreach ($result1 as $row1) {
                                                echo "$row1->schedule_date<hr>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php
                                            $result2 = $this->admin_model->select_appoint_start_time($key);
                                            foreach ($result2 as $row2) {
                                                echo "$row2->from_timing - $row2->to_timing<hr>";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('head_foot/footer'); ?>