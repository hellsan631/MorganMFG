
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

          <?php alert(); ?>          

          <div class="panel panel-default">

            <div class="panel-heading">
              
              <?php if($header_content->slug=="gallery"){ ?>
              <h3>Gallery </h3>
              <?php } elseif($header_content->slug=="team"){ ?>
              <h3>Team </h3>
              <?php }elseif($header_content->slug=="contact"){ ?>
              <h3>Contact </h3>
               <?php }elseif($header_content->slug=="in_the_kitchen"){ ?>
              <h3> In the kitchen </h3>
               <?php }elseif($header_content->slug=="team"){ ?>
              <h3> Team  </h3>
               <?php }elseif($header_content->slug=="profile"){ ?>
              <h3> Profile </h3>
               <?php }elseif($header_content->slug=="catering_detail"){ ?>
              <h3> Catering Detail </h3>
               <?php }elseif($header_content->slug=="catering"){ ?>
              <h3> Catering </h3>
               <?php }elseif($header_content->slug=="catering_partners"){ ?>
              <h3> Catering Partners  </h3>
                <?php } ?>  
             </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Heading</label> 
                    <input type="text" class="form-control" name="heading" id="" value="<?php if(!empty($header_content->heading)) echo $header_content->heading; ?>" placeholder="Enter Heading">
                    <span class="error"><?php echo form_error('heading'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="">Content</label>
                    <textarea placeholder="Enter Content" class="form-control" name="content" rows="10"><?php if(!empty($header_content->content)) echo $header_content->content; ?></textarea>
                    <span class="error"><?php echo form_error('content'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="">Image</label>
                      <input type="file" name="header_image">
                       <?php if(!empty($header_content->image)): ?>
                          <img class="img" src="<?php echo base_url() ?>assets/uploads/header/<?php echo $header_content->image ?>">
                        <?php endif; ?>
                     <span class="error"><?php echo form_error('header_image'); ?></span>
                  </div>

                  <!-- Only For Team Page -->
                  <?php if($header_content->slug=="team" || $header_content->slug=="catering_partners" ||$header_content->slug=="catering"): ?>
                      <div class="form-group">

                          <label for="">Mid Section Heading</label>

                          <input type="text" class="form-control" name="midhead" value="<?php echo $header_content->midhead; ?>" placeholder="Enter Mid Section Heading">

                          <span class="error"><?php echo form_error('midhead'); ?></span>

                      </div>



                      <div class="form-group">

                          <label for="">Mid Section Content</label>

                          <textarea class="mceEditor form-control" name="middescription" rows="3"><?php echo $header_content->middescription; ?></textarea>

                          <span class="error"><?php echo form_error('middescription'); ?></span>

                      </div>

                      <div class="form-group">

                          <label for="">Mid Section Button Text</label>

                          <input type="text" class="form-control" name="midbuttontext" value="<?php echo $header_content->midbuttontext; ?>" placeholder="Enter Mid Section Button Text">

                          <span class="error"><?php echo form_error('midbuttontext'); ?></span>

                      </div>

                      <div class="form-group">

                          <label for="">Mid Section Button Link</label>

                          <input type="text" class="form-control" name="midbuttonlink" value="<?php echo $header_content->midbuttonlink; ?>" placeholder="Enter Mid Section Button Link">

                          <span class="error"><?php echo form_error('midbuttonlink'); ?></span>

                      </div>
                  <?php endif; ?>
                  <!-- Only For Team Page -->

                  <br>
                  <input type="submit" class="btn btn-primary" value="Update">
                </form>             
              </div>            
            </div>            
          </div>          
        </div>
      </div>
    </div>  

    <style type="text/css">
.img
{
  border-radius: 4px;
  height: 100px;
  margin-top: 2%;
  width: 100px;
}
    </style>  