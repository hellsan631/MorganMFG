    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('admin/sidebar'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <?php echo alert(); ?>          
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3>Add Image</h3>
            </div>
            <div class="row">              
              <div class="col-sm-11 col-md-10 main">              
                <?php echo form_open_multipart(current_url()); ?>
               
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gallery Name</label> 
                    <input readonly  type="text" class="form-control" value="<?php echo $gallery_info->name ?>">
                    <span class="error"><?php //echo form_error('name'); ?></span>
                  </div>                 


                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label> 
                    <input required type="text" class="form-control" name="name" id="" value="" placeholder="Enter Image name">
                    <span class="error"><?php //echo form_error('name'); ?></span>
                  </div>                 

                  <div class="form-group">
                    <label for="exampleInputEmail1">Image</label> 
                    <br><small>* Required Size : 850 x 900</small> 

                    <input required type="file" name="image" id="">
                    <span class="error"><?php //echo form_error('name'); ?></span>
                  </div>                 
          
                  
                  <br>
                  <input type="submit" class="btn btn-primary" value="Add">
                </form>
              
              </div>
            
            </div>
            
          </div>

          
        </div>
      </div>
    </div>

    