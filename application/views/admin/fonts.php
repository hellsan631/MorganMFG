<div class="container-fluid">
      <div class="row">
        <?php $this->load->view('admin/sidebar'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php echo alert(); ?>          

          <div class="panel panel-default">

            <div class="panel-heading">
              <h3>Fonts</h3>
            </div>

            <div class="row">              
              <div class="col-sm-11 col-md-10 main">              
                <?php echo form_open_multipart(current_url()); ?> 
                  <div class="form-group">
                    <label class="" for="">Font Url <span style="font-size:10px">Seperated by '||'.</span></label>                  
                      <input  class="form-control" type="text" name="font_url" value="<?php if(!empty($link->font_url)) echo  $link->font_url; ?>" placeholder="@import url(http://fonts.googleapis.com/css?family=Roboto+Condensed); || @import url(http://fonts.googleapis.com/css?family=Open+Sans);">                  
                    <span style="color:red"><?php echo form_error('font_url') ?></span>
                  </div>

                  <div class="form-group">
                    <label class="" for="">Body Font Name</label>                  
                      <input  class="form-control" type="text" name="body" value="<?php if(!empty($link->body)) echo  $link->body; ?>">                  
                    <span style="color:red"><?php echo form_error('body') ?></span>
                  </div>


                  <div class="form-group">
                    <label class="" for="">Paragraphs Font Name</label>                  
                      <input  class="form-control" type="text" name="paragraphs" value="<?php if(!empty($link->paragraphs)) echo  $link->paragraphs; ?>">                  
                    <span style="color:red"><?php echo form_error('paragraphs') ?></span>
                  </div>


                  <div class="form-group">
                    <label class="" for="">Header Font Name</label>                  
                      <input  class="form-control" type="text" name="headers" value="<?php if(!empty($link->headers)) echo  $link->headers; ?>">                  
                    <span style="color:red"><?php echo form_error('headers') ?></span>
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