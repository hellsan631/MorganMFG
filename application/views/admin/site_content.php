<style type="text/css">
  
[class^="icon-"], [class*=" icon-"]
{
    background-image:url("<?php echo base_url() ?>assets/timepicker/glyphicons-halflings.png");
    background-position: 14px 14px;
    background-repeat: no-repeat;
    display: inline-block;
    height: 14px;
    line-height: 14px;
    margin-top: 1px;
    vertical-align: text-top;
    width: 14px;
}
.icon-chevron-up {
    background-position: -288px -120px;
}.icon-chevron-down {
    background-position:-313px -119px;
}
.bootstrap-timepicker-hour
{
  border: 1px solid #afafaf;
  border-radius: 3px;
}.bootstrap-timepicker-minute
{
  border: 1px solid #afafaf;
  border-radius: 3px;
}.bootstrap-timepicker-meridian
{
  border: 1px solid #afafaf;
  border-radius: 3px;
}
</style>


<div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>





        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php echo alert(); ?>          

          <div class="panel panel-default">

            <div class="panel-heading">

              <h3>Site Content</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>                  


                  <div class="form-group">
                    <label class="" for="">Logo Image <span style="font-size:12px">size 140 x 100 in px</span></label>                  
                      <input type="file" name="userfile">
                      <?php if (!empty($site_content->logo)): ?>
                          <img src="<?php echo base_url() ?>assets/uploads/home/<?php echo $site_content->logo; ?>" style="border:1px solid #000">
                      <?php endif ?>
                    <span style="color:red"><?php echo form_error('userfile'); ?></span>
                  </div>

                  <div class="form-group">
                    <label class="" for="">Heading</label>                  
                      <input  class="form-control" type="text" name="heading" value="<?php if(set_value('heading')) echo set_value('heading') ; elseif(!empty($site_content->heading)) echo  $site_content->heading; ?>">                  
                    <span style="color:red"><?php echo form_error('heading') ?></span>
                  </div>                 

                  <div class="form-group">
                    <label class="" for="">Address</label>                  
                      <input  class="form-control" type="text" name="address" value="<?php if(set_value('address')) echo set_value('address') ; elseif(!empty($site_content->address)) echo  $site_content->address; ?>">                  
                    <span style="color:red"><?php echo form_error('address') ?></span>
                  </div>

                  <div class="form-group">
                    <label class="" for="">City</label>                  
                      <input  class="form-control" type="text" name="city" value="<?php if(set_value('city')) echo set_value('city') ; elseif(!empty($site_content->city)) echo  $site_content->city; ?>">                  
                    <span style="color:red"><?php echo form_error('city') ?></span>
                  </div>

                  <div class="form-group">
                    <label class="" for="">Zip Code</label>                  
                      <input  class="form-control" type="text" name="zipcode" value="<?php if(set_value('zipcode')) echo set_value('zipcode') ; elseif(!empty($site_content->zipcode)) echo  $site_content->zipcode; ?>">                  
                    <span style="color:red"><?php echo form_error('zipcode') ?></span>
                  </div>

                  <div class="form-group">
                    <label class="" for="">Phone</label>                  
                      <input  class="form-control" type="text" name="phone" value="<?php if(set_value('phone')) echo set_value('phone') ; elseif(!empty($site_content->phone)) echo  $site_content->phone; ?>">                  
                    <span style="color:red"><?php echo form_error('phone') ?></span>
                  </div>

                  <div class="form-group">
                    <label class="" for="">Fax</label>                  
                      <input  class="form-control" type="text" name="fax" value="<?php if(set_value('fax')) echo set_value('fax') ; elseif(!empty($site_content->fax)) echo  $site_content->fax; ?>">                  
                    <span style="color:red"><?php echo form_error('fax') ?></span>
                  </div>

                  <div class="form-group">
                    <label class="" for="">Country</label>                  
                      <?php $country = get_country_array(); ?>
                      <select class="form-control" name="country">
                        <option value="">Select </option>
                        <?php foreach($country as $key => $value): ?>
                          <option <?php if(set_select('country',$key)) echo "selected"; elseif($site_content->country==$key) echo "selected"; ?> value="<?php echo $key ?>"><?php echo $value?></option>
                        <?php endforeach; ?>
                      </select>
                    <span style="color:red"><?php echo form_error('country') ?></span>
                  </div>

                  <hr>
                  
                  <h1>Contact Page Data</h1>

                  <div class="form-group">
                    <label class="" for="">Contact Email</label>                  
                        <input  class="form-control" type="text" name="contact_email" value="<?php if(set_value('contact_email')) echo set_value('contact_email') ; elseif(!empty($site_content->contact_email)) echo  $site_content->contact_email; ?>">                  
                    <span style="color:red"><?php echo form_error('contact_email') ?></span>
                  </div>

                  <div class="form-group">
                    <label class="" for="">Hours Monday To Thursday</label>                  
                        <input  style="width:30%" id="timepicker1" class="form-control" type="text" name="contact_mon_to_thursday_start" value="<?php if(set_value('contact_mon_to_thursday_start')) echo set_value('contact_mon_to_thursday_start') ; elseif(!empty($site_content->contact_mon_to_thursday_start)) echo  $site_content->contact_mon_to_thursday_start; ?>">                  
                        <span style="color:red"><?php echo form_error('contact_mon_to_thursday_start') ?></span>
                          &nbsp;
                         &nbsp;
                        <input  style="width:30%" id="timepicker2" class="form-control " type="text" name="contact_mon_to_thursday_end" value="<?php if(set_value('contact_mon_to_thursday_end')) echo set_value('contact_mon_to_thursday_end') ; elseif(!empty($site_content->contact_mon_to_thursday_end)) echo  $site_content->contact_mon_to_thursday_end; ?>">                  
                       <span style="color:red"><?php echo form_error('contact_mon_to_thursday_end') ?></span>
                  </div>

                  <div class="form-group">
                    <label class="" for="">Hours Friday</label>                  
                        <input  style="width:30%" id="timepicker3" class="form-control" type="text" name="contact_friday_start" value="<?php if(set_value('contact_friday_start')) echo set_value('contact_friday_start') ; elseif(!empty($site_content->contact_friday_start)) echo  $site_content->contact_friday_start; ?>">                  
                        <span style="color:red"><?php echo form_error('contact_friday_start') ?></span>
                          &nbsp;
                         &nbsp;
                        <input  style="width:30%" id="timepicker4" class="form-control " type="text" name="contact_friday_end" value="<?php if(set_value('contact_friday_end')) echo set_value('contact_friday_end') ; elseif(!empty($site_content->contact_friday_end)) echo  $site_content->contact_friday_end; ?>">                  
                        <span style="color:red"><?php echo form_error('contact_friday_end') ?></span>
                  </div>


                  <br>
                  <input type="submit" class="btn btn-primary" value="Update">

                </form>             

              </div>            

            </div>            

          </div>          

        </div>

      </div>

    </div> 


<script type="text/javascript">
  $('#timepicker1').timepicker({
  <?php if(!empty($site_content->contact_mon_to_thursday_start)) :?>
    defaultTime:""
  <?php endif; ?>
  });
  $('#timepicker2').timepicker({
    <?php if(!empty($site_content->contact_mon_to_thursday_end)) :?>
    defaultTime:""
    <?php endif; ?>
  });
  $('#timepicker3').timepicker({
    <?php if(!empty($site_content->contact_friday_start)) :?>
      defaultTime:""
    <?php endif; ?>
  });
  $('#timepicker4').timepicker({
    <?php if(!empty($site_content->contact_friday_end)) :?>
      defaultTime:""
    <?php endif; ?>
  });
</script>
