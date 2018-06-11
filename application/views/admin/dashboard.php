<?php
$this->load->view('head_foot/header');
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
}
?>
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
            <?php
            $list2 = $this->admin_model->count_buyer();
            foreach ($list2 as $tot1) {
                
            }
            ?><div class="col-12 col-sm-6 col-md-3">
                <a href="<?php echo base_url(); ?>add-buyers">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Buyer's</span>
                            <span class="info-box-number">
                                <?php
                                echo $tot1->count;
                                ?>
                                <small></small>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            $list3 = $this->admin_model->count_seller();
            foreach ($list3 as $tot2) {
                
            }
            ?>
            <div class="col-12 col-sm-6 col-md-3">
                <a href="<?php echo base_url(); ?>add-sellers">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Seller's</span>
                            <span class="info-box-number"><?php echo $tot2->count ?></span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <?php
            $list4 = $this->admin_model->count_event();
            foreach ($list4 as $tot3) {
                
            }
            ?>

            <div class="col-12 col-sm-6 col-md-3">
                <a href="<?php echo base_url(); ?>add-event">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Event's</span>
                            <span class="info-box-number"><?php echo $tot3->count ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">New Members</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('head_foot/footer'); ?>