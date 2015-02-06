<!-- TinyMCE -->

<script type="text/javascript" src="<?php echo base_url() ?>assets/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">



  tinyMCE.init({

    mode : "textareas",
    editor_selector : "mceEditor",

    theme : "advanced",  

    plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks,openmanager",

    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,image,code,|,forecolor|,removeformat|,fullscreen",   

    

    file_browser_callback: "openmanager",

    open_manager_upload_path: '../../../../uploads/'

     }); 

</script>

<!-- /TinyMCE -->



    <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>





        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php echo alert(); ?>          

          <div class="panel panel-default">

            <div class="panel-heading">

              <h3>Edit Catering member</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>

                  <div class="form-group">

                    <label for="exampleInputEmail1">name</label> 

                    <input type="text" class="form-control" name="name" id="" value="<?php echo $catering->member_name; ?>" placeholder="Enter name">

                    <span class="error"><?php echo form_error('name'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="">Contact</label>

                    <input type="text" class="form-control" name="position" value="<?php echo $catering->position; ?>" id="" placeholder="Enter Contact">

                   <span class="error"><?php echo form_error('position'); ?></span>

                  </div>



                  <div class="form-group" style="display:none">

                    <label for="">Description</label>

                    <textarea class="mceEditor form-control" name="description" rows="3"><?php echo $catering->description; ?></textarea>

                    <span class="error"><?php echo form_error('description'); ?></span>

                  </div>


                  <div class="form-group">

                    <label for="">Bio</label>

                    <textarea class="mceEditor form-control" name="bio" rows="3"><?php echo $catering->bio; ?></textarea>

                    <span class="error"><?php echo form_error('bio'); ?></span>

                    <p> How to make link clickable? <a href="<?php echo base_url() ?>catering/clickable" target="_blank">Click here</a> </p>

                  </div>

                  

                 <div class="form-group" style="display:none">

                    <label for="">job title</label>                    

                    <input type="text" class="form-control" name="job_title" id="" value="<?php echo $catering->job_title; ?>" placeholder="Enter job Title">

                    <span class="error"><?php echo form_error('job_title'); ?></span>

                  </div>

                  <div class="form-group" style="display:none">

                    <label for="exampleInputEmail1">Home town</label> 

                    <input type="text" class="form-control" name="hometown" id="" value="<?php echo $catering->hometown; ?>" placeholder="Enter hometown">

                    <span class="error"><?php echo form_error('hometown'); ?></span>

                  </div>

                   <div class="form-group" style="display:block">

                    <label for="exampleInputEmail1">Email</label> 

                    <input type="text" class="form-control" name="email_address" id="" value="<?php echo $catering->email_address; ?>" placeholder="Enter email address">

                    <span class="error"><?php echo form_error('email_address'); ?></span>

                  </div>

                  <div class="form-group" style="display:block">

                    <label for="exampleInputEmail1">Twitter link</label> 

                    <input type="text" class="form-control" name="twitter_link" id="" value="<?php echo $catering->twitter_link; ?>" placeholder="Enter twitter_link">

                    <span class="error"><?php echo form_error('twitter_link'); ?></span>

                  </div>

                 

                  <div class="form-group" style="display:block">

                    <label for="exampleInputEmail1">Facebook link</label> 

                    <input type="text" class="form-control" name="fb_link" id="" value="<?php echo $catering->fb_link; ?>" placeholder="">

                    <span class="error"><?php echo form_error('fb_link'); ?></span>

                  </div>



                  <div class="form-group">

                    <label for="exampleInputFile">Image</label>

                    <input type="file" name="userfile" id="exampleInputFile">

                    <!-- <p class="help-block">Example block-level help text here.</p> -->

                    <?php if (!empty($catering->member_image)): ?><br>

                        <img src="<?php echo base_url() ?>assets/uploads/catering/thumbs/<?php echo $catering->member_image; ?>" width='100'>

                    <?php endif ?>

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



    