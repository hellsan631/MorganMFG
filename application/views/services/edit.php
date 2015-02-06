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
              <h3>Edit Service Content</h3>
            </div>
           

            <div class="row">              
              <div class="col-sm-11 col-md-10 main">              
                <?php echo form_open_multipart(current_url()); ?>               

                             

                  <div class="form-group img-contnt" >
                    <label for="">Heading</label>
                    <input type="text" class="form-control" name="heading" value="<?php echo $section->heading; ?>" id="" placeholder="Enter Heading" required>
                   <span class="error"><?php echo form_error('heading'); ?></span>
                  </div>
                 
                  <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="mceEditor form-control" name="description" rows="10"><?php echo $section->description; ?></textarea>                    
                  </div>
                  <div class="form-group img-contnt" >
                    <label for="exampleInputFile">Image</label>
                    <p>Cover ( 1280 x 625 ) , Left or Right ( 540 x 510 ) </p>
                    <input type="file" name="userfile" >

                    <?php if (!empty($section->image)): ?>
                        <img src="<?php echo base_url() ?>assets/uploads/services/<?php echo $section->image; ?>" width='100'>
                    <?php endif ?>

                  </div> 
                   <div class="form-group img-contnt" >
                    <div class="selectbox">
                      <label for="">Text Alignment</label>
                      <select name="align" class="form-control">                       
                        <option value="left" <?php if($section->image_align == 'left') echo "selected='selected'" ?> >Left</option>                                                
                        <option value="right" <?php if($section->image_align == 'right') echo "selected='selected'" ?> >Right</option>                        
                        <option value="cover" <?php if($section->image_align == 'cover') echo "selected='selected'" ?> >Cover</option>                        
                      </select>
                      <span class="error"><?php echo form_error('type'); ?></span>
                  </div>
                  </div>
                  <div class="form-group img-contnt" >
                    <label for="">Button Name</label>
                    <input type="text" class="form-control" name="btn_txt" value="<?php echo $section->btn_txt; ?>" id="" placeholder="Enter Button Url" >
                    <span class="error"><?php echo form_error('btn_txt'); ?></span>
                  </div> 
                  <div class="form-group img-contnt" >
                    <label for="">Button Url</label>
                    <input type="text" class="form-control" name="btn_url" value="<?php echo $section->btn_url; ?>" id="" placeholder="Enter Button Url" >
                    <span class="error"><?php echo form_error('btn_url'); ?></span>
                  </div> 
                   <div class="form-group">
                    <label for="">Order</label>
                    <input type="text" class="form-control" name="order" value="<?php echo $section->order; ?>" id="" placeholder="Enter order" required>
                   <span class="error"><?php echo form_error('order'); ?></span>
                  </div> 
                
                  <input type="submit" class="btn btn-primary" value="Save">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>   