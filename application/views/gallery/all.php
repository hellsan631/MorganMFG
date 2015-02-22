
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
                Gallery
                <span style="float: right;">
                  <a class="btn btn-primary" style="margin:-5px;" href="<?php echo base_url() ?>gallery/add">
                    Add new
                  </a>
                </span>
              </h4>
            </div>
            <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>                  
                  <th>Caption</th>
                  <th>Name</th>
                  <th>Image</th>
                  <!-- <th>Images</th> -->
                  <th>Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($gallery): foreach ($gallery as $row): ?>
                <tr>
                  <td><?php echo $row->name ?></td>
                  <td><?php echo $row->image ?></td>
                  <td><img style="width:100px;height:100px;" src="<?php echo base_url() ?>assets/uploads/gallery/thumbs/<?php echo $row->image ?>"></td>
                  <?php /* 
                  <td>
                    <a  href="<?php echo base_url() ?>gallery/all_images/<?php echo $row->slug; ?>">
                        <i class="glyphicon glyphicon-picture"></i>
                        Images
                        <?php 
                            // $count = get_all_class_sections($row->id,'count'); 
                            // if($count > 1)
                            // {
                            //     echo $count.' Sections';
                            // }    
                            // else    
                            // {
                            //     echo $count.' Section';
                            // }    
                        ?>
                    </a>
                  </td> 

                  */ ?>

                                                     
                  <td><?php echo date('Y-m-d',strtotime( $row->created)); ?></td>                                    
                  <td>
                    <a href="<?php echo base_url() ?>gallery/edit/<?php echo $row->slug; ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                    &nbsp;&nbsp;&nbsp;  
                    <a onclick="return confirm('Are you sure?')" href="<?php echo base_url() ?>gallery/delete/<?php echo $row->id; ?>"><i class="glyphicon glyphicon-remove"></i></a>
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