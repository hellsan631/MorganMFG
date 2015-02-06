 <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  

        <?php alert(); ?>        

          <div class="panel panel-default">

            <div class="panel-heading">

              <h4>

                Videos

                <span style="float: right;">

                  <a class="btn btn-primary" style="margin:-5px;" href="<?php echo base_url() ?>home/addVideo">
                    Add new
                  </a>
                </span>
              </h4>

            </div>

            <div class="table-responsive">

            <table class="table table-striped">

              <thead>

                <tr>                  

                  <th>Heading</th>
                  <th>Order</th>
                  <th>Mp4</th>
                  <th>Webm</th>
                  <th>ogv</th>
                  <th>Action</th>

                </tr>

              </thead>

              <tbody>

                <?php if ($videos): foreach ($videos as $row) { ?>

                <tr>
                  <td><?php echo $row->heading; ?></td>
                  <td><?php echo $row->order; ?></td>
                  <td><a class="btn btn-success" href="<?php echo base_url().'assets/uploads/videos/'.$row->mp4; ?>" target="_blank">Preview</a></td>
                  <td><a class="btn btn-success" href="<?php echo base_url().'assets/uploads/videos/'.$row->webm; ?>" target="_blank">Preview</a></td>
                  <?php if(!empty($row->ogv)): ?>
                    <td><a class="btn btn-success" href="<?php echo base_url().'assets/uploads/videos/'.$row->ogv; ?>" target="_blank">Preview</a></td>
                  <?php else: ?>
                  <td>N/A</td> 
                  <?php endif; ?>                                  
                  <td>
                    <a href="<?php echo base_url() ?>home/editVideo/<?php echo $row->id ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                         &nbsp;&nbsp;&nbsp;  
                         <a onclick="return confirm('Are you sure?')" href="<?php echo base_url() ?>home/deleteVideo/<?php echo $row->id ?>"><i class="glyphicon glyphicon-remove"></i></a>                  
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