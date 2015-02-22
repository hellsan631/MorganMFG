    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('admin/sidebar'); ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <?php echo alert(); ?>          
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3>Add Gallery</h3>
            </div>
            <div class="row">              
              <div class="col-sm-11 col-md-10 main">              
                <?php echo form_open_multipart(current_url()); ?>
               
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label> 
                    <input type="text" class="form-control" name="name" id="" value="<?php echo set_value('name'); ?>" placeholder="">
                    <span class="error"><?php echo form_error('name'); ?></span>
                  </div>                 

                  <div class="form-group">
                    <label for="exampleInputEmail1">Image </label>
                    <br><small>* Required Size : 640 x 412</small> 
                    <input type="file" name="image" id="">
                    <span class="error"><?php echo form_error('image'); ?></span>
                  </div> 

                  <div class="form-group">
                    <label for="exampleInputEmail1">Order</label> 
                    <input type="text" class="form-control" name="order" id="" value="<?php echo set_value('order'); ?>" placeholder="">
                    <span class="error"><?php echo form_error('order'); ?></span>
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

    