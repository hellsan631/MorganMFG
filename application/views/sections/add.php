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

              <h3>Add Section</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Heading</label> 

                    <input type="text" class="form-control" name="heading" id="" value="<?php echo set_value('heading'); ?>" placeholder="Enter Heading">

                    <span class="error"><?php echo form_error('heading'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="">Sub-Heading</label>

                    <input type="text" class="form-control" name="sub_heading" value="<?php echo set_value('sub_heading'); ?>" id="" placeholder="Enter Sub Heading">

                   <span class="error"><?php echo form_error('sub_heading'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="">Button Text</label>

                    <input type="text" class="form-control" name="button_text" value="<?php echo set_value('button_text'); ?>" id="" placeholder="Enter Button Text">

                   <span class="error"><?php echo form_error('button_text'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="">Button Link</label>

                    <input type="text" class="form-control" name="button_link" value="<?php echo set_value('button_link'); ?>" id="" placeholder="Enter Button Link">

                   <span class="error"><?php echo form_error('button_link'); ?></span>

                  </div>




                  <div class="form-group">

                    <label for="exampleInputFile">Icon 
<!--                     <span style="font-weight:lighter">(size:60x60)</span >
 -->                    </label>

                    <input type="file" name="icon" id="exampleInputFile">

                   <span class="error"><?php echo form_error('icon'); ?></span>

                  </div>


                  <div class="form-group">

                    <label for="exampleInputFile">Background Image 
<!--                     <span style="font-weight:lighter">(size:1400x700)</span>
 -->                    </label>

                    <input type="file" name="image" id="exampleInputFile">

                   <span class="error"><?php echo form_error('image'); ?></span>

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



    