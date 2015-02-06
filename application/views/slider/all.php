
    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('admin/sidebar'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  
        <?php alert(); ?>        
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>
               All Slides
                <span style="float: right;">
                  <a class="btn btn-primary" style="margin:-5px;" href="<?php echo base_url() ?>slider/add">
                    Add new
                  </a>
                </span>
              </h4>
            </div>
            <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>                  
                  <th>Image</th>
                  <th>Headline</th>
                  <th>Order</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($slides): foreach ($slides as $row) { ?>
                <tr>
                  <td><img src="<?php echo base_url() ?>assets/uploads/slider/<?php echo $row->image; ?>" width="100"></td>
                  <td><?php echo $row->headline ?></td>                                    
                  <td><?php echo $row->order ?></td>                                  
                  <td>
                    <a href="<?php echo base_url() ?>slider/edit/<?php echo $row->id ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                         &nbsp;&nbsp;&nbsp;  
                         <a onclick="return confirm('Are you sure?')" href="<?php echo base_url() ?>slider/delete/<?php echo $row->id ?>"><i class="glyphicon glyphicon-remove"></i></a>
                  </td>
                  
                </tr>               
                <?php  } endif ?>
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