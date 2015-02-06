

    <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  

        <?php alert(); ?>        

          <div class="panel panel-default">

            <div class="panel-heading">

              <h4>

                Space

                <span style="float: right;">

                  <a class="btn btn-primary" style="margin:-5px;" href="<?php echo base_url() ?>spaces/add">

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

                  <th>Title</th>

                  <th>Description</th>

                  <th>Created</th>

                  <th>Action</th>

                </tr>

              </thead>

              <tbody>

                <?php if ($space): foreach ($space as $row) { ?>

                <tr>

                  <td>
                    <?php if (!empty($row->image)): ?>

                        <img src="<?php echo base_url() ?>assets/uploads/space/thumbs/<?php echo $row->image; ?>" width='100'>

                    <?php endif ?>
                  </td>

                  <td><?php echo $row->title ?></td>

                  <td><?php echo word_limiter($row->description, 5); ?></td>                                    

                  <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>                                    

                  <td>

                    <a href="<?php echo base_url() ?>spaces/edit/<?php echo $row->slug ?>"><i class="glyphicon glyphicon-pencil"></i></a>

                         &nbsp;&nbsp;&nbsp;  

                         <a onclick="return confirm('Are you sure?')" href="<?php echo base_url() ?>spaces/delete/<?php echo $row->slug ?>"><i class="glyphicon glyphicon-remove"></i></a>

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