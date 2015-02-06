
    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('admin/sidebar'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  
        <?php alert(); ?>        
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>
                News Letters
                <!-- <span style="float: right;">
                  <a class="btn btn-primary" style="margin:-5px;" href="<?php echo base_url() ?>contactus/add">
                    Add new
                  </a>
                </span> -->
              </h4>
            </div>
            <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>                                    
                  <th>Email</th>
<!--                   <th>Status</th>
 -->                  <th>Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($newsletter): foreach ($newsletter as $row) { ?>
                <tr>
                  
                  <td><?php echo $row->email ?></td>                                    
<!--                   <td><?php  //if($row->subscription == 1){ echo "Subscribed"; }else{ echo "Unubscribed"; } ?></td>                                    
 -->                  <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>                                    
                  <td>                                          
                         <a onclick="return confirm('Are you sure you want to delete it?')" href="<?php echo base_url() ?>newsletter/delete/<?php echo $row->id ?>"><i class="glyphicon glyphicon-remove"></i></a>
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