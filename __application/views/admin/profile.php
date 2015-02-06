


<style type="text/css">
  .iamg_imag
  {
    width:100px;
    height: 100px;
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

              <h3>Admin Profile</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>                  

                  <div class="form-group">
                    <label class="" for="">First Name</label>                  
                      <input  class="form-control" type="text" name="first_name" value="<?php if(set_value('first_name')) echo set_value('first_name') ; elseif(!empty($admin_info->first_name)) echo  $admin_info->first_name; ?>">                  
                    <span style="color:red"><?php echo form_error('first_name') ?></span>
                  </div>

                  <div class="form-group">
                    <label class="" for="">Last Name</label>                  
                      <input  class="form-control" type="text" name="last_name" value="<?php if(set_value('last_name')) echo set_value('last_name') ; elseif(!empty($admin_info->last_name)) echo  $admin_info->last_name; ?>">                  
                    <span style="color:red"><?php echo form_error('last_name') ?></span>
                  </div>


                  <div class="form-group">
                    <label class="" for="">Description</label>                  
                      <input  class="form-control" type="text" name="description" value="<?php if(set_value('description')) echo set_value('description') ; elseif(!empty($admin_info->description)) echo  $admin_info->description; ?>">                  
                    <span style="color:red"><?php echo form_error('description') ?></span>
                  </div>

                  <div class="form-group">
                    <label class="" for="">Image </label>   (200x200) px               
                     <input type="file" name="image">
                    <span style="color:red"><?php echo form_error('image') ?></span>
                  </div>

              <?php if(!empty($admin_info->image)): ?>
                  <div class="form-group">
                    <label class="" for=""></label>                  
                      <img class="iamg_imag" src="<?php echo base_url() ?>assets/uploads/profile/<?php echo $admin_info->image ?>">
                  </div>
             <?php endif; ?>


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
    defaultTime:""
  });
  $('#timepicker2').timepicker({
    defaultTime:""
  });
  $('#timepicker3').timepicker({
    defaultTime:""
  });
  $('#timepicker4').timepicker({
    defaultTime:""
  });
</script>
