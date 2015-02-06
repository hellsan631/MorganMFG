
<style>
a:hover{
    text-decoration: none;
    cursor: pointer;
}
</style>

    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('admin/sidebar'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  
        <?php alert(); ?>        
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>
                <?php echo $gallery_info->name ?> Images
                <span style="float: right;">
                  <a class="btn btn-primary" style="margin:-5px;" href="<?php echo base_url() ?>gallery/add_images/<?php echo $gallery_info->slug ?>">
                    Add new
                  </a>
                </span>
              </h4>
            </div>
            <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>                  
                  <th>Name</th>
                  <th>Image</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($gallery_images): foreach ($gallery_images as $row): ?>
                <tr>
                  <td><?php echo $row->name ?></td>
                  <td><img style="width:100px;height:100px;" src="<?php echo base_url() ?>assets/uploads/gallery_images/thumbs/<?php echo $row->image ?>"></td>
                  <td><?php echo date('Y-m-d',strtotime( $row->created)); ?></td>                                    
                  <td>
                    <a href="<?php echo base_url() ?>gallery/edit_images/<?php echo $row->slug; ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                    &nbsp;&nbsp;&nbsp;  
                    <a onclick="return confirm('Are you sure?')" href="<?php echo base_url() ?>gallery/delete_images/<?php echo $row->id; ?>"><i class="glyphicon glyphicon-remove"></i></a>
                  </td>
                </tr>    

                <?php endforeach; ?>            
                <?php else:?>
                  <tr>                  
                     <td colspan="5">No records Found </td>
                  </tr>
                <?php endif; ?>

              </tbody>
            </table>
            <div>
              <?php echo $pagination; ?>
            </div>
          </div>
          </div>         
        </div>
      </div>
    </div>