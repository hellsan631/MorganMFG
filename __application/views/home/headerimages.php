<div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>





        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php echo alert(); ?>          

          <div class="panel panel-default">

            <div class="panel-heading">

              <h3>Header Images</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>                  
                  <h4>Contact US page</h4>
                  <div class="form-group">
                  <label class="" for="">Heading</label>                  
                    <input  class="form-control" type="text" name="contactxt" value="<?php if(!empty($image->contactxt)) echo  $image->contactxt; ?>">                  
                  <span style="color:red"><?php echo form_error('contactxt') ?></span>
                  </div>

                  <div class="form-group">
                  <label class="" for="">Image</label>    
                  <p> ( 1280 x 640 ) </p>              
                   <input type="file" name="contactimg">
                   <?php if (!empty($image->contactimg)): ?>
                     <img src="<?php echo base_url() ?>assets/uploads/home/<?php echo $image->contactimg ?>" width="100">
                   <?php endif ?>                  
                  </div>

                  <hr>
                  <h4>Closet page</h4>
                  <!-- <div class="form-group">
                  <label class="" for="">Heading</label>                  
                    <input  class="form-control" type="text" name="closetxt" value="<?php if(!empty($image->closetxt)) echo  $image->closetxt; ?>">                  
                  <span style="color:red"><?php echo form_error('closetxt') ?></span>
                  </div> -->

                  <div class="form-group">
                  <label class="" for="">Image</label>  
                  <p> ( 1280 x 640 ) </p>                
                   <input type="file" name="closetimg">
                   <?php if (!empty($image->closetimg)): ?>
                     <img src="<?php echo base_url() ?>assets/uploads/home/<?php echo $image->closetimg ?>" width="100">
                   <?php endif ?>                  
                  </div>
                  <hr>

                   <h4>Styling page</h4>
                  <div class="form-group">
                  <!-- <label class="" for="">Heading</label>                  
                    <input  class="form-control" type="text" name="stylingtxt" value="<?php if(!empty($image->stylingtxt)) echo  $image->stylingtxt; ?>">                  
                  <span style="color:red"><?php echo form_error('stylingtxt') ?></span>
                  </div> -->

                  <div class="form-group">
                  <label class="" for="">Image</label>   
                  <p> ( 1280 x 640 ) </p>               
                   <input type="file" name="stylingimg">
                   <?php if (!empty($image->stylingimg)): ?>
                     <img src="<?php echo base_url() ?>assets/uploads/home/<?php echo $image->stylingimg ?>" width="100">
                   <?php endif ?>                  
                  </div>
                  

                 
                  <br>
                  <input type="submit" name="submit" class="btn btn-primary" value="Update">

                </form>             

              </div>            

            </div>            

          </div>          

        </div>

      </div>

    </div> 

