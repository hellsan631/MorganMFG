    <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>





        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php echo alert(); ?>          

          <div class="panel panel-default">

            <div class="panel-heading">

              <h3>Add Slide</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Heading</label> 

                    <input type="text" class="form-control" name="headline" id="" value="<?php echo set_value('headline'); ?>">

                    <span class="error"><?php echo form_error('headline'); ?></span>

                  </div> 

                  <div class="form-group">

                    <label for="exampleInputEmail1">Subheading</label> 

                    <input type="text" class="form-control" name="sub_headline" id="" value="<?php echo set_value('sub_headline'); ?>">

                    <span class="error"><?php echo form_error('sub_headline'); ?></span>

                  </div>              



                  <div class="form-group">

                    <label for="exampleInputFile">Image</label>

                    <input type="file" name="userfile" id="exampleInputFile">

                    <!-- <p class="help-block">Example block-level help text here.</p> -->

                  </div>

                  <?php /* ?>
                  <div class="form-group">

                    <label for="exampleInputEmail1">Button text</label> 

                    <input type="text" class="form-control" name="btn_txt" id="" value="<?php echo set_value('btn_txt'); ?>" placeholder="">

                    <span class="error"><?php echo form_error('btn_txt'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Button link</label> 

                    <input type="text" class="form-control" name="btn_link" id="" value="<?php echo set_value('btn_link'); ?>" placeholder="">

                    <span class="error"><?php echo form_error('btn_link'); ?></span>

                  </div> 
                  */ ?>

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



    