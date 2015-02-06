

    <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  

        <?php alert(); ?>        

          <div class="panel panel-default">

            <div class="panel-heading">

              <h4>

                About page content

                <span style="float: right;">

                  <a class="btn btn-primary" style="margin:-5px;" href="<?php echo base_url() ?>about/add">
                    Add new
                  </a>
                </span>
              </h4>

            </div>

            <div class="table-responsive">

            <table class="table table-striped">

              <thead>

                <tr>   
                  <th>Type</th>
                  <th>Heading</th>
                  <th>Order</th>
                  <th>Created</th>
                  <th>Action</th>

                </tr>

              </thead>

              <tbody>

                <?php if ($about): foreach ($about as $row) { ?>

                <tr>

                  <td><?php if($row->type == 1){ echo 'Image'; }elseif($row->type == 2){ echo 'Text'; }elseif($row->type == 3){ echo 'Company Logos'; } ?></td>                                    
                  <td><?php echo $row->heading ?></td>
                  <td><?php echo $row->order ?></td>                                                      
                  <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>                         
                  <td>
                    <a href="<?php echo base_url() ?>about/edit/<?php echo $row->id ?>"><i class="glyphicon glyphicon-pencil"></i></a>

                         &nbsp;&nbsp;&nbsp;  

                         <a onclick="return confirm('Are you sure?')" href="<?php echo base_url() ?>about/delete/<?php echo $row->id ?>"><i class="glyphicon glyphicon-remove"></i></a>

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