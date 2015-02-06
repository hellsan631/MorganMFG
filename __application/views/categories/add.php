    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('admin/sidebar'); ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <?php echo alert(); ?>          
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3>Add Category</h3>
            </div>
            <div class="row">              
              <div class="col-sm-11 col-md-10 main">              
                <?php echo form_open_multipart(current_url()); ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label> 
                    <input type="text" class="form-control" name="name" id="" value="<?php echo set_value('name'); ?>" placeholder="Enter Category name">
                    <span class="error"><?php echo form_error('name'); ?></span>
                  </div>   
                  <?php /* ?>             
                  <div class="form-group">
                    <div class="selectbox">
                      <label for="">Type</label>
                      <select name="type" class="form-control">
                        <option value="">Please select</option>
                        <option value="1">News</option>                        
                        <!-- <option value="2">Property</option>                         -->
                      </select>
                      <span class="error"><?php echo form_error('type'); ?></span>
                  </div>
                  </div>
                  <?php */ ?>

                  
                  <br>
                  <input type="submit" class="btn btn-primary" value="Add">
                </form>
              
              </div>
            
            </div>
            
          </div>

          
        </div>
      </div>
    </div>

    