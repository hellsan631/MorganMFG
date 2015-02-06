<div class="container">
      <div class="spacer"></div>     

      <div class="spacer"></div>

      <div class="row">
        
        <div class="col-md-12 col-sm-12 feature-text">
          <h3><?php echo $post->title; ?></h3> <br>
          <?php if (!empty($post->image)): ?>
            <img src="<?php echo base_url() ?>assets/uploads/news/<?php echo $post->image ?>" class="feature-photo"><br><br>            
          <?php endif ?>
          <p>
            <?php echo $post->description; ?>
          </p>
        </div> <!-- /.feature-text -->              
      </div> <!-- /.post -->
    </div> <!-- /.container -->


    <style type="text/css">
      .navbar{
        border-bottom: 2px solid;
      }
    </style>