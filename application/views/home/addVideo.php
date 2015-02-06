   <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>





        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php echo alert(); ?>          

          <div class="panel panel-default">

            <div class="panel-heading">

              <h3>Add Videos</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                 <?php echo form_open_multipart(current_url(), array('class' => 'cmxform form-horizontal form-example')); ?>

                 <?php echo form_error('check_webm_file'); ?>
                 <?php echo form_error('check_mp4_file'); ?>
                 <?php echo form_error('check_ogv_file'); ?>

                  <div class="form-group ">
                      <label for="heading" class="control-label col-lg-2">Heading</label>
                      <div class="col-lg-10">
                          <input class="form-control" id="heading" type="text" name="heading" value="<?php echo set_value('heading'); ?>"/>
                      </div>
                      <div class="col-lg-10 col-lg-offset-2">
                          <label for="heading" class="error"><?php echo form_error('heading'); ?></label>
                      </div>
                  </div>

                  <div class="form-group ">
                      <label for="subheading" class="control-label col-lg-2">Subheading</label>
                      <div class="col-lg-10">
                          <input class="form-control" id="subheading" type="text" name="subheading" value="<?php echo set_value('subheading'); ?>"/>
                      </div>
                      <div class="col-lg-10 col-lg-offset-2">
                          <label for="subheading" class="error"><?php echo form_error('subheading'); ?></label>
                      </div>
                  </div>

                  <div class="form-group ">
                      <label for="btn_text" class="control-label col-lg-2">Button Text</label>
                      <div class="col-lg-10">
                          <input class="form-control" id="btn_text" type="text" name="btn_text" value="<?php echo set_value('btn_text'); ?>"/>
                      </div>
                      <div class="col-lg-10 col-lg-offset-2">
                          <label for="btn_text" class="error"><?php echo form_error('btn_text'); ?></label>
                      </div>
                  </div>

                  <div class="form-group ">
                      <label for="btn_link" class="control-label col-lg-2">Button Link</label>
                      <div class="col-lg-10">
                          <input class="form-control" id="btn_link" type="text" name="btn_link" value="<?php echo set_value('btn_link'); ?>"/>
                      </div>
                      <div class="col-lg-10 col-lg-offset-2">
                          <label for="btn_link" class="error"><?php echo form_error('btn_link'); ?></label>
                      </div>
                  </div>

                  <div class="form-group ">
                      <label for="order" class="control-label col-lg-2">Video Order (required)</label>
                      <div class="col-lg-10">
                          <input class="focused-input form-control" id="order" type="text" name="order" value="<?php echo set_value('order'); ?>"/>
                          <!-- <input class="focused-input form-control" id="caption" type="text" name="caption" value="<?php // if(set_value('caption')){ echo set_value('caption'); }elseif(!empty($content)){ echo $content->caption; } ?>"/> -->
                      </div>
                      <div class="col-lg-10 col-lg-offset-2">
                          <label for="order" class="error"><?php echo form_error('order'); ?></label>
                      </div>
                  </div>

                  <div class="form-group ">
                      <label for="mp4" class="control-label col-lg-2"> MP4 (required)</label>
                      <div class="col-lg-10">
                          <input type="file" type="video/mp4" name="mp4">
                      </div>
                      <div class="col-lg-10 col-lg-offset-2">
                          <label for="mp4" class="error"><?php echo form_error('mp4'); ?></label>
                      </div>
                  </div>

                  <div class="form-group ">
                      <label for="webm" class="control-label col-lg-2"> WebM  </label>
                      <div class="col-lg-10">
                          <input type="file" type="video/webm" name="webm">
                      </div>
                      <div class="col-lg-10 col-lg-offset-2">
                          <label for="webm" class="error"><?php echo form_error('webm'); ?></label>
                      </div>
                  </div>

                   <div class="form-group ">
                      <label for="ogv" class="control-label col-lg-2"> OGV (For Firefox, required)</label>
                      <div class="col-lg-10">
                          <input type="file" type="video/ogv" name="ogv">
                      </div>
                      <div class="col-lg-10 col-lg-offset-2">
                          <label for="ogv" class="error"><?php echo form_error('ogv'); ?></label>
                      </div>
                  </div>


                  <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                          <input type="hidden" name="Submit" value=1>
                          <button type="submit" class="btn btn-info">Submit</button>
                      </div>
                  </div>
              <?php echo form_close(); ?>

              

              </div>

            

            </div>

            

          </div>



          

        </div>

      </div>

    </div>    