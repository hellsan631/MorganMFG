
    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('admin/sidebar'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  
        <?php alert(); ?>        
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>
                Appointments Form
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
                  <th>For</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($appointments): foreach ($appointments as $row) { ?>
                <tr>
                  <td><?php if($row->type == '1') { echo "Wardrobe tune-up"; } elseif($row->type == '2') { echo "Styling"; } elseif($row->type == '3') { echo "Personal Shopping"; } else { echo "Consultation"; } ?></td>
                  <td><?php echo $row->firstname ?></td>
                  <td><?php echo $row->lastname ?></td>
                  <td><?php echo $row->email ?></td>                                    
                  <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>                                    
                  <td>
                    <a href="<?php echo base_url() ?>appointments/view/<?php echo $row->id ?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                         &nbsp;&nbsp;&nbsp;  
                         <a onclick="return confirm('Are you sure?')" href="<?php echo base_url() ?>appointments/delete/<?php echo $row->id ?>"><i class="glyphicon glyphicon-remove"></i></a>
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