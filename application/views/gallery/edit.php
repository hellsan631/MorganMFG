    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('admin/sidebar'); ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <?php echo alert(); ?>          
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3>Edit Gallery</h3>
            </div>
            <div class="row">              
              <div class="col-sm-11 col-md-10 main">              
                <?php echo form_open_multipart(current_url()); ?>
               
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label> 
                    <input required type="text" class="form-control" name="name" id="" value="<?php echo $gallery->name ?>" placeholder="Enter Gallery name">
                    <span class="error"><?php echo form_error('name'); ?></span>
                  </div>                 

                  <div class="form-group">
                    <label for="exampleInputEmail1">Image</label> 
                    <br><small>* Required Size : 640 x 412</small> 
                    <input  type="file" name="image" id="">
                    <span class="error"><?php //echo form_error('name'); ?></span>
                    <br>
                  <img style="width:100px;height:100px" src="<?php echo base_url() ?>assets/uploads/gallery/<?php echo $gallery->image ?>">
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

    