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

              <h3>Edit Team member</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>

                  <div class="form-group">

                    <label for="exampleInputEmail1">name</label> 

                    <input type="text" class="form-control" name="name" id="" value="<?php echo $team->member_name; ?>">

                    <span class="error"><?php echo form_error('name'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="">Position</label>

                    <input type="text" class="form-control" name="position" value="<?php echo $team->position; ?>">

                   <span class="error"><?php echo form_error('position'); ?></span>

                  </div>



                 

                  <div class="form-group">

                    <label for="">Bio</label>

                    <textarea class="mceEditor form-control" name="bio" rows="3"><?php echo $team->bio; ?></textarea>

                    <span class="error"><?php echo form_error('bio'); ?></span>

                    <!-- <p> How to make link clickable? <a href="<?php echo base_url() ?>catering/clickable" target="_blank">Click here</a> </p> -->

                  </div>

                  

               
                   <div class="form-group">

                    <label for="exampleInputEmail1">Email</label> 

                    <input type="email" class="form-control" name="email_address" id="" value="<?php echo $team->email_address; ?>" >

                    <span class="error"><?php echo form_error('email_address'); ?></span>

                  </div>

                  <div class="form-group" style="display:block">

                    <label for="exampleInputEmail1">Twitter link</label> 

                    <input type="text" class="form-control" name="twitter_link" id="" value="<?php echo $team->twitter_link; ?>">

                    <span class="error"><?php echo form_error('twitter_link'); ?></span>

                  </div>

                 

                  <div class="form-group" style="display:block">

                    <label for="exampleInputEmail1">Facebook link</label> 

                    <input type="text" class="form-control" name="fb_link" id="" value="<?php echo $team->fb_link; ?>">

                    <span class="error"><?php echo form_error('fb_link'); ?></span>

                  </div>



                  <div class="form-group">

                    <label for="exampleInputFile">Image</label>

                    <input type="file" name="userfile" id="exampleInputFile">


                    <?php if (!empty($team->member_image)): ?><br>

                        <img src="<?php echo base_url() ?>assets/uploads/team/thumbs/<?php echo $team->member_image; ?>" width='100'>

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



    