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
                    <div class="selectbox">
                      <label for="">Section Type</label>
                      <select name="type" id="type" class="form-control">                       
                        <option value="2">Text</option>                        
                        <option value="1">Image</option>                        
                        <!-- <option value="3">Company logos</option>                         -->
                      </select>
                      <span class="error"><?php echo form_error('type'); ?></span>
                  </div>
                  </div>                 

                  <div class="form-group txt-contnt">
                    <label for="">Heading</label>
                    <input type="text" class="form-control" name="heading" value="<?php echo set_value('heading'); ?>" id="" placeholder="Enter Heading" >
                   <span class="error"><?php echo form_error('heading'); ?></span>
                  </div>

                  <div class="form-group txt-contnt">
                    <label for="">Description</label>
                    <textarea class="mceEditor form-control" name="description" rows="10"><?php echo set_value('description'); ?></textarea>                    
                  </div>
                  <div class="form-group img-contnt" style="display:none">
                    <label for="exampleInputFile">Image</label>
                    <p>( 1400 x 800 ) </p>
                    <input type="file" name="userfile" >
                  </div> 
                   
                   <div class="form-group ">
                    <label for="">Order</label>
                    <input type="text" class="form-control" name="order" value="<?php echo set_value('order'); ?>" id="" placeholder="Enter order" required>
                   <span class="error"><?php echo form_error('order'); ?></span>
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

    <script type="text/javascript">
        $(document).ready(function(){
           $('.logo-contnt').hide();
        });

        $('#type').change(function(){
          var val = $(this).val();
          if(val == '2'){

            $('.img-contnt').hide();  
            $('.logo-contnt').hide();  
            $('.txt-contnt').show();  

          }else if(val == '3'){

            $('.img-contnt').hide();  
            $('.txt-contnt').hide();  
            $('.logo-contnt').show();  

          }else if(val == '1'){

            $('.txt-contnt').hide();  
            $('.logo-contnt').hide();  
            $('.img-contnt').show();  

          }
          
        });

    </script>

    <script type="text/javascript">    
      $('#addmore').on('click', function(){
        var val_count = $('.cntme').length;
        var count = parseInt(val_count+1);
        $('#more_img').append('<div class="form-group cntme gal'+count+'"><input type="file" name="gall[]" class="gal'+count+'"><br><a href="javascript:void(0)" onclick="remove_me('+count+')" class="gal'+count+'" data-rem="gal'+count+'"> remove</a></div>');
      });   


      function remove_me(count){                    
        $('.gal'+count).remove();
      }         

  </script>