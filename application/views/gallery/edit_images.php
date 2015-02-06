    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('admin/sidebar'); ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <?php echo alert(); ?>          
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3>Edit Image</h3>
            </div>
            <div class="row">              
              <div class="col-sm-11 col-md-10 main">              
                <?php echo form_open_multipart(current_url()); ?>
               
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gallery</label> 
                    <input readonly type="text" class="form-control"  value="<?php echo $gallery_info->name ?>">
                    <span class="error"><?php //echo form_error('name'); ?></span>
                  </div>                 

                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label> 
                    <input required type="text" class="form-control" name="name" id="" value="<?php echo $gallery_images_info->name ?>" placeholder="Enter Gallery name">
                    <span class="error"><?php echo form_error('name'); ?></span>
                  </div>                 

                  <div class="form-group">
                    <label for="exampleInputEmail1">Image</label> 
                    <br><small>* Required Size : 850 x 900</small> 
                    <input  type="file" name="image" id="">
                    <span class="error"><?php //echo form_error('name'); ?></span>
                    <br>
                  <img style="width:100px;height:100px" src="<?php echo base_url() ?>assets/uploads/gallery_images/<?php echo $gallery_images_info->image ?>">
                  </div>                 
          
                  
                  <br>
                  <input type="submit" class="btn btn-primary" value="Edit">
                </form>
              
              </div>
            
            </div>
            
          </div>

          
        </div>
      </div>
    </div>

    