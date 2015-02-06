

    <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  

        <?php alert(); ?>        

          <div class="panel panel-default">

            <div class="panel-heading">

              <h4>

                Sections

                <span style="float: right;">

                  <a class="btn btn-primary" style="margin:-5px;" href="<?php echo base_url() ?>sections/add">

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

                  <th>Sub Heading</th>

                  <th>Image</th>

                  <th>Created</th>

                  <th>Action</th>

                </tr>

              </thead>

              <tbody>

                <?php if ($sections): foreach ($sections as $row) { ?>

                <tr>


                  <td><?php echo $row->heading ?></td>

                  <td><?php echo $row->sub_heading ?></td> 

                  <td>
                      <img src="<?php echo base_url() ?>assets/uploads/sections/image/thumbs/<?php echo $row->image; ?>" class="img_img">
                  </td>                                   

                  <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>                                    

                  <td>

                    <a href="<?php echo base_url() ?>sections/edit/<?php echo $row->id ?>"><i class="glyphicon glyphicon-pencil"></i></a>

                         &nbsp;&nbsp;&nbsp;  

                         <a onclick="return confirm('Are you sure?')" href="<?php echo base_url() ?>sections/delete/<?php echo $row->id ?>"><i class="glyphicon glyphicon-remove"></i></a>

                  </td>

                  

                </tr>               

                <?php  } ?>
                <?php else: ?>
                 <tr><td colspan="5">
                     No Records Found.
                 </td></tr>
                <?php endif ?>

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

    <style type="text/css">
    .img_img
    {
     width:100px;
     height:100px;
     border-radius: 2px;
     border:2px solid grey;

    }
      </style>