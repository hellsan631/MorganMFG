<!-- TinyMCE -->

<script type="text/javascript" src="<?php echo base_url() ?>assets/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">



  tinyMCE.init({

    mode : "textareas",
    editor_selector : "mceEditor",

    theme : "advanced",  

    // plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks,openmanager",

    // theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,image,code,|,forecolor|,removeformat|,fullscreen",   

    plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks,openmanager,jbimages",   

    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,code,|,forecolor|,removeformat|,fullscreen,jbimages",   

    

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

              <h3>Add Post</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">              

                <?php echo form_open_multipart(current_url()); ?>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Title</label> 

                    <input type="text" class="form-control" name="title" id="" value="<?php echo set_value('title'); ?>" placeholder="Enter Title">

                    <span class="error"><?php echo form_error('title'); ?></span>

                  </div>

                  <!--<div class="form-group">

                    <label for="">Heading</label>

                    <input type="text" class="form-control" name="heading" value="<?php echo set_value('heading'); ?>" id="" placeholder="Enter Heading">

                   <span class="error"><?php echo form_error('heading'); ?></span>

                  </div>-->

                  <div class="form-group">

                    <label for="">Excerpt</label>

                    <textarea class="form-control" name="excerpt" rows="5"><?php echo set_value('excerpt'); ?></textarea>

                    <span class="error"><?php echo form_error('excerpt'); ?></span>

                  </div>

                  <div class="form-group">

                    <label for="">Description</label>

                    <textarea class="mceEditor form-control" name="description" rows="10"><?php echo set_value('description'); ?></textarea>

                    <span class="error"><?php echo form_error('description'); ?></span>

                  </div>

                   <!-- <div class="form-group">

                    <label for="exampleInputEmail1">Author Name</label> 

                    <input type="text" class="form-control" name="author_name" id="" value="<?php echo set_value('author_name'); ?>" placeholder="Enter Author Name">
                    <span class="error"><?php echo form_error('author_name'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="">About Author</label>
                    <textarea class="form-control" name="author_description" rows="5"><?php echo set_value('author_description'); ?></textarea>
                    <span class="error"><?php echo form_error('author_description'); ?></span>
                  </div> -->

                  <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <p> ( 750 x 480 ) </p>
                    <input type="file" name="userfile" id="exampleInputFile">
                  </div>


                  <div class="form-group">
                    <div class="selectbox">
                      <label for="">Category</label>
                      <select name="category_id" class="form-control">                       
                        <option value="">please select</option>                        
                        <?php if ($category): foreach($category as $row): ?>                            
                          <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>                                                
                        <?php endforeach; endif; ?>
                      </select>
                      <span class="error"><?php echo form_error('category_id'); ?></span>
                  </div>
                  </div>

                  <div class="form-group">
                    <div class="selectbox">
                      <label for="">Status</label>
                      <select name="status" class="form-control">                       
                        <option value="1">Publish</option>                        
                        <option value="0">unpublish</option>                        
                      </select>
                      <span class="error"><?php echo form_error('status'); ?></span>
                  </div>
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



    