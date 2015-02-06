

    <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  

        <?php alert(); ?>        

          <div class="panel panel-default">

            <div class="panel-heading">

              <h4>

                Services page content

                <span style="float: right;">

                  <a class="btn btn-primary" style="margin:-5px;" href="<?php echo base_url() ?>services/add">
                    Add new
                  </a>
                </span>
              </h4>

            </div>

            <div class="table-responsive">

            <table class="table table-striped">

              <thead>

                <tr>   
                  <!-- <th>Type</th> -->
                  <th>Heading</th>
                  <th>Order</th>
                  <th>Created</th>
                  <th>Action</th>

                </tr>

              </thead>

              <tbody>

                <?php if ($services): foreach ($services as $row) { ?>

                <tr>                  
                  <td><?php echo $row->heading ?></td>
                  <td><?php echo $row->order ?></td>                                                      
                  <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>                         
                  <td>
                    <a href="<?php echo base_url() ?>services/edit/<?php echo $row->id ?>"><i class="glyphicon glyphicon-pencil"></i></a>

                         &nbsp;&nbsp;&nbsp;  

                         <a onclick="return confirm('Are you sure?')" href="<?php echo base_url() ?>services/delete/<?php echo $row->id ?>"><i class="glyphicon glyphicon-remove"></i></a>

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