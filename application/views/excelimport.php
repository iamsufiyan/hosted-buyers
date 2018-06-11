<?php if($this->session->flashdata('message')){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>

<br><br>

<div align="center">
<form action="<?php echo base_url(); ?>index.php/uploadcsv/import" 
method="post" name="upload_excel" enctype="multipart/form-data">
<input type="file" name="file" id="file">
<button type="submit" id="submit" name="import">Import</button>
</form>
<br>
<br>
<a href="<?php echo base_url(); ?>sample.csv"> Sample csv file </a>
<br><br>

<div style="width:80%; margin:0 auto;" align="center">
<table id="t01">
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Date</th>
  </tr>
<?php
if(isset($view_data) && is_array($view_data) && count($view_data)): $i=1;
foreach ($view_data as $key => $data) { 
?>
  <tr>
    <td><?php echo $data['name'] ?></td>
    <td><?php echo $data['email'] ?></td>
    <td><?php echo $data['created_date'] ?></td>
  </tr>
  <?php } endif; ?>
</table>
</div>
</div>