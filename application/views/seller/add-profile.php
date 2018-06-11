<?php
$this->load->view('head_foot/header-seller');
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
    $refno_gen = ($this->session->userdata['logged_in']['refno_gen']);
    //echo "$username<br>$email<br>$refno_gen";
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add Profile</h3>
            </div>
            <?php
            if (validation_errors() != false) {
                echo "<div class='alert alert-danger alert-dismissible' style='margin: 20px;'>";
                echo "<i style='font-size: 24px;';><span class='fa fa-warning'></span> Required Fields</i>";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                echo validation_errors();
                echo "</div>";
            }
            $result = $this->seller_model->select_seller_ref($refno_gen);
            foreach ($result as $row) {
                
            }
            ?>
            <br>
            <br>
            <form role="form" action="<?php echo base_url() ?>upload-image-seller"  id="myform" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <form role="form" action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="row" style="margin-right: 0px; margin-left: 0px;">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="">
                                    <img class="profile-user-img" style="width: 225px; height: 252px;" src="<?php echo base_url(); ?>uploads/<?php echo $row->user_pic ?>" alt="User profile picture">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="hidden" id="refno" name="refno" value="<?php echo $refno_gen; ?>"/>                        
                            <label for="userfile">Image-Upload</label>
                            <input type="file" name="userfile" class="form-control" id="userfile" size="20" />
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-top:29px">
                        <input type="submit" name="userSubmit" value="upload" id="submit" class="btn btn-info" />
                    </div>
                </div>
            </form>
            <br>
            <hr style="background: black;">
            <br>
            <form class="form-horizontal" action="<?php echo base_url() ?>insert-seller-profile" method="post" accept-charset="utf-8">                    
                <input type="hidden" name="refno" class="form-control" value="<?php echo $row->refno_gen ?>" placeholder="Enter Register Number">
                <div class="row" style="margin-right: 0px; margin-left: 0px;">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name" class="col-sm-6 control-label">Name</label>
                            <div class=" ">
                                <input class="form-control" name="name" value="<?php echo $row->name ?>" id="name" placeholder="Enter Name" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title" class="col-sm-6 control-label">Title</label>
                            <select class="form-control" name="title" tabindex="-1" aria-hidden="true">                                        
                                <option value="<?php echo $row->title ?>"><?php echo $row->title ?></option>
                                <option value="Mr">Mr</option>
                                <option value="Ms">Ms</option>
                                <option value="Mrs">Mrs</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dob" class="col-sm-6 control-label">DOB</label>
                            <input type="date" class="form-control" name="dob" value="<?php echo $row->DOB ?>" id="dob">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation" class="col-sm-6 control-label">Designation</label>
                            <div class=" ">
                                <input class="form-control" name="designation" value="<?php echo $row->Designation ?>" id="designation" placeholder="Enter Designation" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="company" class="col-sm-6 control-label">Company</label>

                            <div class=" ">
                                <input class="form-control" name="company" value="<?php echo $row->company ?>" id="company" placeholder="Enter Company Name" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="addr1" class="col-sm-12 control-label">Address 1</label>
                            <div class=" ">
                                <input class="form-control" name="addr1" value="<?php echo $row->addr1 ?>" id="addr1" placeholder="Enter Address 1" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="addr2" class="col-sm-6 control-label">Address 2</label>
                            <div class=" ">
                                <input class="form-control" name="addr2" value="<?php echo $row->addr2 ?>" id="addr2" placeholder="Enter Address 2" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="city" class="col-sm-6 control-label">City</label>
                            <div class=" ">
                                <input type="text" name="city" class="form-control" value="<?php echo $row->city ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="zcode" class="col-sm-6 control-label">Zip Code</label>
                            <div class=" ">
                                <input class="form-control" name="zcode" value="<?php echo $row->postal_code ?>" id="zcode" placeholder="Enter Zip Code" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tphone" class="col-sm-6 control-label">Phone Number</label>
                            <div class=" ">
                                <input class="form-control" name="tphone" value="<?php echo $row->telephone ?>" id="tphone" placeholder="Enter Telephone No" type="number">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mphone" class="col-sm-6 control-label">Mobile Number</label>
                            <div class=" ">
                                <input class="form-control" name="mphone" value="<?php echo $row->mobile_number ?>" id="mphone" placeholder="Enter Mobile No" type="number">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cweb" class="col-sm-12 control-label">Enter Company Website</label>
                            <div class=" ">
                                <input class="form-control" name="cweb" value="<?php echo $row->company_website ?>" id="cweb" placeholder="Enter Company Website" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="iata" class="col-sm-12 control-label">Are You IATA Member</label>
                            <div class=" ">
                                <input class="form-control" name="iata" value="<?php echo $row->are_you_iata_member ?>" id="iata" placeholder="IATA Member Yes / No" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="buisness" class="col-sm-12 control-label">What best describes your business?</label>
                            <div class=" ">
                                <input class="form-control" name="buisness" value="<?php echo $row->what_best_describes_your_business ?>" id="buisness" placeholder="describes business" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="organisations_affiliated" class="col-sm-12 control-label">Organisations affiliated</label>
                            <div class="">
                                <input class="form-control" name="organisations_affiliated" value="<?php echo $row->organisations_affiliated ?>" id="organisations_affiliated" placeholder="Enter Organisations Affiliated" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="annual" class="col-sm-12 control-label">Annual sales volume in INR</label><br>
                            <div class="">
                                <input class="form-control" name="annual" value="<?php echo $row->annual_sales ?>" id="annual" placeholder="Enter Annual sales volume in INR" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Destination" class="col-sm-12 control-label">Destinations promoted in India</label><br>
                            <div class="">
                                <input class="form-control" name="destination" value="<?php echo $row->destinations_promoted ?>" id="Destination" placeholder="Enter Destinations promoted in India" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="company_profile" class="col-sm-12 control-label">Company profile</label><br>
                            <div class="">
                                <input class="form-control" name="company_profile" value="<?php echo $row->company_profile ?>" id="company_profile" placeholder="Enter Company profile" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pip" class="col-sm-12 control-label">Photo Id Proof</label><br>
                            <div class="">
                                <input class="form-control" name="pip" value="<?php echo $row->photo_id_proof ?>" id="pip" placeholder="Enter Photo Id Proof" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="passenger" class="col-sm-12 control-label">How many passengers did you handle last year?</label>
                            <div class="">
                                <input class="form-control" name="passenger" value="<?php echo $row->passengers_lastyear ?>" id="passenger" placeholder="How many passengers did you handle last year?" type="text">
                            </div>
                        </div>
                    </div><div class="col-md-3">
                        <div class="form-group">
                            <label for="attented" class="col-sm-12 control-label">Which other events have you atended as a Hosted Buyer</label>
                            <div class="">
                                <input class="form-control" name="attented" value="<?php echo $row->attented ?>" id="attented" placeholder="" type="text">
                            </div>
                        </div>
                    </div>




                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
            </form>

            <div class='resp_code frms'>                            
                <div id="dumdiv" align="center" style=" font-size: 10px;color: #dadada;">
                    <a id="dum" style="padding-right:0px; text-decoration:none;color: green;text-align:center;" href="http://www.hscripts.com"></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<?php $this->load->view('head_foot/footer'); ?>