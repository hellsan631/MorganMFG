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

    open_manager_upload_path: '../../../uploads/'

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

              <h3>Update Contact Us Address</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Heading</label> 

                    <input type="text" class="form-control" name="contact_heading" id="" value="<?php echo $page_content->contact_heading; ?>">

                    <span class="error"><?php echo form_error('contact_heading'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="">Address</label>

                    <textarea class="mceEditor form-control" name="contact_address" rows="10"><?php echo $page_content->contact_address; ?></textarea>

                    <span class="error"><?php echo form_error('contact_address'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Email</label> 

                    <input type="text" class="form-control" name="contact_email" id="" value="<?php echo $page_content->contact_email; ?>">

                    <span class="error"><?php echo form_error('contact_email'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Phone</label> 

                    <input type="text" class="form-control" name="contact_phone" id="" value="<?php echo $page_content->contact_phone; ?>">

                    <span class="error"><?php echo form_error('contact_phone'); ?></span>

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