<?php
$this->load->view('head_foot/header');
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
}
?>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">View Appointment</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-xs-6 col-md-6">
                            <table class="table table-hover table-bordered responsive">
                                <tr>
                                    <th>Sino</th>
                                    <th>Event Name</th>
                                    <th>View</th>
                                </tr>
                                <?php
                                $i = 1;
                                $result = $this->admin_model->select_appoint();
                                foreach ($result as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row->event_name ?></td>
                                        <td><a href='<?php echo base_url(); ?>Admin_registration/view_slot/<?php echo $row->event_key ?>' class='fa fa-eye'></a></td>
                                    </tr>
                                    <?php
                                    $i += 1;
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
<?php
$this->load->view('head_foot/footer');
?>