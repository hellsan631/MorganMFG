<div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>





        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php echo alert(); ?>          

          <div class="panel panel-default">

            <div class="panel-heading">

              <h3>Edit Playlist ID</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

               <?php echo form_open_multipart(current_url(), array('class' => 'cmxform form-horizontal form-example')); ?>

                                        <div class="form-group ">
                                          <label for="playlist_id" class="control-label col-lg-2">Playlist ID</label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="playlist_id" type="text" name="playlist_id" value="<?php echo $video->playlist_id; ?>"/>
                                          </div>
                                          <div class="col-lg-10 col-lg-offset-2">
                                              <label for="playlist_id" class="error"><?php echo form_error('playlist_id'); ?></label>
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="heading" class="control-label col-lg-2">Heading</label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="heading" type="text" name="heading" value="<?php echo $video->heading; ?>"/>
                                          </div>
                                          <div class="col-lg-10 col-lg-offset-2">
                                              <label for="heading" class="error"><?php echo form_error('heading'); ?></label>
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="subheading" class="control-label col-lg-2">Subheading</label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="subheading" type="text" name="subheading" value="<?php echo $video->subheading; ?>"/>
                                          </div>
                                          <div class="col-lg-10 col-lg-offset-2">
                                              <label for="subheading" class="error"><?php echo form_error('subheading'); ?></label>
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="btn_text" class="control-label col-lg-2">Button Text</label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="btn_text" type="text" name="btn_text" value="<?php echo $video->btn_text; ?>"/>
                                          </div>
                                          <div class="col-lg-10 col-lg-offset-2">
                                              <label for="btn_text" class="error"><?php echo form_error('btn_text'); ?></label>
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="btn_link" class="control-label col-lg-2">Button Link</label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="btn_link" type="text" name="btn_link" value="<?php echo $video->btn_link; ?>"/>
                                          </div>
                                          <div class="col-lg-10 col-lg-offset-2">
                                              <label for="btn_link" class="error"><?php echo form_error('btn_link'); ?></label>
                                          </div>
                                      </div>

                                        

                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button type="submit" class="btn btn-info">Update</button>
                                            </div>
                                        </div>
                                    <?php echo form_close(); ?>  

              </div>            

            </div>            

          </div>          

        </div>

      </div>

    </div>



    