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
                    <h3>Edit Event</h3>
                </div>
                <div class="row">
                    <div class="col-sm-11 col-md-10 main">
                        <?php echo form_open_multipart(current_url()); ?>               
                        <div class='form-group '>
                            <label >Title</label>
                            <input type='text' class='form-control' name='title' value='<?php echo $rows->title; ?>'> 
                            <span class='error'><?php echo form_error('title'); ?></span>
                        </div>
                        <div class='form-group '>
                            <label >Description</label>
                            <textarea class='mceEditor form-control' rows='10' name='description'><?php echo $rows->description; ?></textarea>
                            <span class='error'><?php echo form_error('description'); ?></span>
                        </div>
                        <div class='form-group '>
                            <label >Image (Size:87x76)</label>
                            <input type='file' name='image'>
                            <?php if(trim($rows->image)): ?>
                            <br><br><img style='width:200px; height:200px;' src='<?php echo base_url(); ?>assets/uploads/event/<?php echo $rows->image; ?>'>
                            <?php endif; ?>
                            <span class='error'><?php echo form_error('image'); ?></span>
                        </div>
                        <div class='form-group '>
                            <label >Order</label>
                            <input type='text' class='form-control' name='order' value='<?php echo $rows->order; ?>'> 
                            <span class='error'><?php echo form_error('order'); ?></span>
                        </div>
                        <div class='form-group'>
                            <input name='submit' type='submit' class='btn btn-primary' value='Edit'>
                        </div>
                        <?php echo form_close(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>