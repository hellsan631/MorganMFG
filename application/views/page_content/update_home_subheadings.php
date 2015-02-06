    <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>





        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php echo alert(); ?>          

          <div class="panel panel-default">

            <div class="panel-heading">

              <h3>Update Home Page Sub Header</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Blog Sub Heading</label> 

                    <input type="text" class="form-control" name="home_blog_subheading" id="" value="<?php echo $page_content->home_blog_subheading; ?>">

                    <span class="error"><?php echo form_error('home_blog_subheading'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Moda Mentore Mentions Sub Heading</label> 

                    <input type="text" class="form-control" name="home_mention_subheading" id="" value="<?php echo $page_content->home_mention_subheading; ?>">

                    <span class="error"><?php echo form_error('home_mention_subheading'); ?></span>

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