<div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>





        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php echo alert(); ?>          

          <div class="panel panel-default">

            <div class="panel-heading">

              <h3>Social Links</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>                  

                  <div class="form-group">
                  <label class="" for="">Facebook</label>                  
                    <input  class="form-control" type="text" name="facebook" value="<?php if(!empty($link->facebook)) echo  $link->facebook; ?>">                  
                  <span style="color:red"><?php echo form_error('facebook') ?></span>
                  </div>

                  <div class="form-group">
                  <label class="control-label" for="">Twitter</label>                  
                    <input  class="form-control" type="text" name="twitter" value="<?php if(!empty($link->twitter)) echo  $link->twitter; ?>">                  
                  <span style="color:red"><?php echo form_error('twitter') ?></span>
                  </div>

                  <div class="form-group">
                  <label class="control-label" for="">Instagram</label>                  
                    <input  class="form-control" type="text" name="instagram" value="<?php if(!empty($link->instagram)) echo  $link->instagram; ?>">                  
                  <span style="color:red"><?php echo form_error('instagram') ?></span>
                  </div>

                  <div class="form-group">
                  <label class="control-label" for="">googleplus</label>                  
                    <input  class="form-control" type="text" name="googleplus" value="<?php if(!empty($link->googleplus)) echo  $link->googleplus; ?>">                  
                  <span style="color:red"><?php echo form_error('googleplus') ?></span>
                  </div>

                  <div class="form-group">
                  <label class="control-label" for="">Twitter Username</label>                  
                    <input  class="form-control" type="text" name="twitter_username" value="<?php if(!empty($link->twitter_username)) echo  $link->twitter_username; ?>">                  
                  <span style="color:red"><?php echo form_error('twitter_username') ?></span>
                  </div>  

                  <div class="form-group">
                  <label class="control-label" for="">Pinterest</label>                  
                    <input  class="form-control" type="text" name="pinterest" value="<?php if(!empty($link->pinterest)) echo  $link->pinterest; ?>">                  
                  <span style="color:red"><?php echo form_error('pinterest') ?></span>
                  </div>  

                  <div class="form-group">
                  <label class="control-label" for="">Linkedin</label>                  
                    <input  class="form-control" type="text" name="linkedin" value="<?php if(!empty($link->linkedin)) echo  $link->linkedin; ?>">                  
                  <span style="color:red"><?php echo form_error('linkedin') ?></span>
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

