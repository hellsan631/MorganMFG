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

              <h3>Add Amenity</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Title</label> 

                    <input type="text" class="form-control" name="title" id="" value="<?php echo set_value('title'); ?>">

                    <span class="error"><?php echo form_error('title'); ?></span>

                  </div>

                  



                  <div class="form-group">

                    <label for="">Description</label>

                    <textarea class="mceEditor form-control" name="description" rows="10"><?php echo set_value('description'); ?></textarea>

                    <span class="error"><?php echo form_error('description'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="">Button Text</label>

                    <input type="text" class="form-control" name="btn_txt" value="<?php echo set_value('btn_txt'); ?>">

                   <span class="error"><?php echo form_error('btn_txt'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="">Button Link</label>

                    <input type="text" class="form-control" name="link" value="<?php echo set_value('link'); ?>">

                   <span class="error"><?php echo form_error('link'); ?></span>

                  </div>
                   
                  <div class="form-group">

                    <label for="exampleInputFile">Image ( 1024 x 577 ) </label>

                    <input type="file" name="userfile" id="exampleInputFile">

                    <span class="error"><?php echo form_error('userfile'); ?></span>

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



    