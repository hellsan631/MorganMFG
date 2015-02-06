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

              <h3>Edit Service</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Heading</label> 

                    <input type="text" class="form-control" name="headline" id="" value="<?php echo $slider->headline; ?>" >

                    <span class="error"><?php echo form_error('headline'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Subheading</label> 

                    <input type="text" class="form-control" name="sub_headline" id="" value="<?php echo $slider->sub_headline; ?>" >

                    <span class="error"><?php echo form_error('sub_headline'); ?></span>

                  </div>               



                  



                  <div class="form-group">

                    <label for="exampleInputFile">Image</label>

                    <input type="file" name="userfile" id="exampleInputFile">

                    <!-- <p class="help-block">Example block-level help text here.</p> -->

                    <?php if (!empty($slider->image)): ?><br>

                        <img src="<?php echo base_url() ?>assets/uploads/slider/<?php echo $slider->image; ?>" width='100'>

                    <?php endif ?>

                  </div>
                  <?php /* ?>
                  <div class="form-group">

                    <label for="exampleInputEmail1">Button text</label> 

                    <input type="text" class="form-control" name="btn_txt" id="" value="<?php echo $slider->btn_txt; ?>" placeholder="">

                    <span class="error"><?php echo form_error('btn_txt'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Button link</label> 

                    <input type="text" class="form-control" name="btn_link" id="" value="<?php echo $slider->btn_link; ?>" placeholder="">

                    <span class="error"><?php echo form_error('btn_link'); ?></span>

                  </div>
                  <?php */ ?>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Order</label> 

                    <input type="text" class="form-control" name="order" id="" value="<?php echo $slider->order; ?>" placeholder="">

                    <span class="error"><?php echo form_error('order'); ?></span>

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



    