<style type="text/css">
/*#reimagined { type = cover
text-align: center;
background: url(../img/closet.jpg);
background-size: cover;
}*/
</style>
<?php $arr = array(); if ($content): $z = 0; foreach($content as $row): $z++; ?>

    <?php
      if($row->image_align == 'cover'){
        $class = '';
      }
      else{
        $class = 'incHeight'.$z;
        $arr[] = array('key' => $z, 'class'=>$class, 'img' => base_url().'assets/uploads/services/'.$row->image);
      }
    ?>
    
    <?php if($row->image_align == 'cover'){ ?>
    <section id="reimagined" class="<?php echo $class ?>" style="text-align:center; background:url('<?php echo base_url() ?>assets/uploads/services/<?php echo $row->image; ?>');background-size: cover;">
      <div class="container">
        <h1><?php echo $row->heading; ?></h1>
        <?php echo $row->description; ?>
        <?php if (!empty($row->btn_txt) && !empty($row->btn_url)): ?>
              <a href="<?php echo $row->btn_url ?>" class="btn btn-black"><?php echo $row->btn_txt; ?></a>              
            <?php endif ?>
      </div>
    </section>  
    <?php }elseif($row->image_align == 'left'){ ?>

    <?php /* ?>
      <section id="consulting" class="<?php echo $class ?>" style="background: url('<?php echo base_url() ?>assets/uploads/services/<?php echo $row->image; ?>') top left no-repeat; background-size: contain;">
      <div class="container">
        <div class="row">
          <div class="col-md-7 col-md-offset-5">
            <h1><?php echo $row->heading ?></h1>
            <?php echo $row->description; ?>
            <?php if (!empty($row->btn_txt) && !empty($row->btn_url)): ?>
              <a href="<?php echo $row->btn_url ?>" class="btn btn-black"><?php echo $row->btn_txt; ?></a>              
            <?php endif ?>
          </div>
        </div>
      </div>
    </section>

    */ ?>

    <section id="consulting" class="<?php echo $class ?>" style="padding:0px; background:transparent" class="wm">
      <div class="">
        <div class="row" style="margin-left:0px; margin-right:0px">
          <div class="col-md-5" style="padding-left:0px">
            <img src="<?php echo base_url() ?>assets/uploads/services/<?php echo $row->image; ?>" style="width: 100%;" >
          </div>
          <div class="col-md-7" style="padding-left: 4%; padding-right: 6%; padding-top: 6%; padding-bottom: 4%;">
            <h1><?php echo $row->heading ?></h1>
            <?php echo $row->description; ?>
             <?php if (!empty($row->btn_txt) && !empty($row->btn_url)): ?>
              <a href="<?php echo $row->btn_url ?>" class="btn btn-black"><?php echo $row->btn_txt; ?></a>              
            <?php endif ?>
          </div>
          
        </div>
      </div>
    </section>

    <?php }elseif($row->image_align == 'right'){ ?>  

      <section id="consulting" class="<?php echo $class ?>" style="padding:0px; background:transparent">
      <div class="">
        <div class="row" style="margin-left:0px; margin-right:0px">
          <div class="col-md-7" style="padding-left:7% ; padding-top: 6%; padding-bottom:4% ">
           <h1><?php echo $row->heading ?></h1>
            <?php echo $row->description; ?>
             <?php if (!empty($row->btn_txt) && !empty($row->btn_url)): ?>
              <a href="<?php echo $row->btn_url ?>" class="btn btn-black"><?php echo $row->btn_txt; ?></a>              
            <?php endif ?>
          </div>
          <div class="col-md-5" style="padding-right:0px; ">
            <img src="<?php echo base_url() ?>assets/uploads/services/<?php echo $row->image; ?>" style="width: 100%;" >
          </div>
        </div>
      </div>
    </section>

    <?php /* ?>
      <section id="consulting" class="<?php echo $class ?>" style="background: url('<?php echo base_url() ?>assets/uploads/services/<?php echo $row->image ?>') top right #f7f7f7 no-repeat;" >
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <h1><?php echo $row->heading; ?></h1>
              <?php echo $row->description; ?>
              <?php if (!empty($row->btn_txt) && !empty($row->btn_url)): ?>
                <a href="<?php echo $row->btn_url ?>" class="btn btn-black"><?php echo $row->btn_txt; ?></a>              
              <?php endif ?>
            </div>
          </div>
        </div>
      </section>
      <?php */ ?>
    <?php }  ?>
<?php endforeach; endif; ?>
    

  <script type="text/javascript">
    $(document).ready(function(){
      $('body section').each(function(){
        console.log($(this));
        $(this).find('img').css('min-height', parseInt( parseInt($(this).height()) + 10 )+'px');
      });
    });
  </script>
    

    

    <!-- <section id="consulting" class="phone">
      <div class="container">
        <div class="row">
          <div class="col-md-7 col-md-offset-5">
            <h1>THE ONLY APP<br>THAT MATTERS.</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <a href="#" class="btn btn-black">DOWNLOAD NOW</a>
          </div>
        </div>
      </div>
    </section>
 -->
    <!-- <section id="comment">
      <div class="container">
        <h2>“It’s a new era in fashion - there are no rules. It’s all services the individual and personal style, wearing high-end, low-end, classic labels, and up-and-coming designers all together..”</h2>
        <p class="name">-Alexander McQueen</p>
      </div>
    </section> -->