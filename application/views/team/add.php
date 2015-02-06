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

              <h3>Add Team Member</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Member Name</label> 

                    <input type="text" class="form-control" name="name"  value="<?php echo set_value('name'); ?>">

                    <span class="error"><?php echo form_error('name'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="">Position</label>

                    <input type="text" class="form-control" name="position" value="<?php echo set_value('position'); ?>">

                   <span class="error"><?php echo form_error('position'); ?></span>

                  </div>



               

                   <div class="form-group">

                    <label for="">biography</label>

                    <textarea class="mceEditor form-control" name="bio" rows="10"><?php echo set_value('bio'); ?></textarea>

                    <span class="error"><?php echo form_error('bio'); ?></span>

                    <!-- <p> How to make link clickable? <a href="<?php echo base_url() ?>catering/clickable" target="_blank">Click here</a> </p> -->

                  </div>

                  
                  <div class="form-group" >

                    <label for="">Email</label>

                    <input type="text" class="form-control" name="email_address" value="<?php echo set_value('email_address'); ?>" >

                   <span class="error"><?php echo form_error('email_address'); ?></span>

                  </div>  

                   <div class="form-group" >

                    <label for="">twitter link</label>

                    <input type="text" class="form-control" name="twitter_link" value="<?php echo set_value('twitter_link'); ?>">

                   <span class="error"><?php echo form_error('twitter_link'); ?></span>

                  </div>

                   

                  <div class="form-group" >

                    <label for="">Facebook link</label>

                    <input type="text" class="form-control" name="fb_link" value="<?php echo set_value('fb_link'); ?>">

                   <span class="error"><?php echo form_error('fb_link'); ?></span>

                  </div>               

                  



                  <div class="form-group">

                    <label for="exampleInputFile">Image</label>

                    <input type="file" name="userfile" id="exampleInputFile">

                    <!-- <p class="help-block">Example block-level help text here.</p> -->

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



    