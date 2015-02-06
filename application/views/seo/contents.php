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
              <h3>Seo Page Content</h3>
            </div>
           

            <div class="row">              
              <div class="col-sm-11 col-md-10 main">              
                <?php echo form_open_multipart(current_url()); ?>

                  <div class="form-group img-contnt" >
                    <label for="">Title (upto 55 character)</label>
                    <input type="text" class="form-control" name="title" value="<?php if(!empty($page)){ if(!empty($page->title)) { echo $page->title; } } ?>" placeholder="Enter title">
                    <span class="error"><?php echo form_error('title'); ?></span>
                  </div>
                 
                  <div class="form-group">
                    <label for="">Description Page Description (Best to keep 150-160 characters)</label>
                    <!-- mceEditor  --><textarea class="form-control" name="description" rows="10"><?php if(!empty($page)){ if(!empty($page->description)) { echo $page->description; } } ?></textarea>                    
                    <span class="error"><?php echo form_error('description'); ?></span>
                  </div>
                
                  <div class="form-group img-contnt" >
                    <label for="">Keyword (Best to keep 100-160 characters)</label>
                    <input type="text" class="form-control" name="keyword" value="<?php if(!empty($page)){ if(!empty($page->keyword)) { echo $page->keyword; } } ?>" placeholder="Enter keyword">
                    <span class="error"><?php echo form_error('keyword'); ?></span>
                  </div>

                  <input type="submit" class="btn btn-primary" value="Save">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>   