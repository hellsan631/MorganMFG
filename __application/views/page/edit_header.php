



    <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php alert(); ?>          

          <div class="panel panel-default">

            <div class="panel-heading">
              
              <?php if($header_content->slug=="contact"){ ?>
              <h3>Contact </h3>
               <?php }elseif($header_content->slug=="in_the_kitchen"){ ?>
              <h3> In the kitchen </h3>
               <?php }elseif($header_content->slug=="team"){ ?>
              <h3> Team </h3>
               <?php }elseif($header_content->slug=="profile"){ ?>
              <h3> Profile </h3>
                <?php } ?>  
             </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Heading</label> 
                    <input type="text" class="form-control" name="heading" id="" value="<?php if(!empty($header_content->heading)) echo $header_content->heading; ?>" placeholder="Enter Heading">
                    <span class="error"><?php echo form_error('heading'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="">Content</label>
                    <textarea placeholder="Enter Content" class="form-control" name="content" rows="10"><?php if(!empty($header_content->content)) echo $header_content->content; ?></textarea>
                    <span class="error"><?php echo form_error('content'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="">Image</label>
                      <input type="file" name="header_image">
                       <?php if(!empty($header_content->image)): ?>
                          <img class="img" src="<?php echo base_url() ?>assets/uploads/header/<?php echo $header_content->image ?>">
                        <?php endif; ?>
                     <span class="error"><?php echo form_error('header_image'); ?></span>
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

    <style type="text/css">
.img
{
  border-radius: 4px;
  height: 100px;
  margin-top: 2%;
  width: 100px;
}
    </style>  