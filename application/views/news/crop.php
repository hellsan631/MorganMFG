<script src="<?php echo base_url() ?>assets/plugins/Jcrop/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/Jcrop/js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/Jcrop/css/jquery.Jcrop.css" type="text/css" />

<div class="container-fluid">

  <div class="row">

    <?php $this->load->view('admin/sidebar'); ?>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

      <?php echo alert(); ?>          

      <div class="panel panel-default">

        <div class="panel-heading">

          <h3>Crop Post Image</h3>

        </div>

        <div class="row">              

          <div class="col-sm-11 col-md-10 main">              

            <?php echo form_open_multipart(current_url(),array('onsubmit'=>'return checkCoords();')); ?>

              <input type="hidden" id="x" name="x" />
              <input type="hidden" id="y" name="y" />
              <input type="hidden" id="w" name="w" />
              <input type="hidden" id="h" name="h" />

              <div class="form-group">

                <img id="cropbox" src="<?php echo base_url() ?>assets/uploads/news/<?php echo $news->image; ?>">

              </div>
              
              <br>

              <input type="submit" class="btn btn-primary" value="Crop Image">

              <a href="<?php echo base_url() ?>blog/all" class="btn btn-danger" style="margin-left: 2%;"> Cancel </a>

            </form>             

          </div>            

        </div>            

      </div>          

    </div>

  </div>

</div>

<script type="text/javascript">

  $(function(){
    $('#cropbox').Jcrop({
      aspectRatio: 1,
      // setSelect:   [0, 0, 200,200],
      touchSupport: true,
      boxWidth: 500,
      onSelect: updateCoords
    });
  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press crop.');
    return false;
  };

</script>