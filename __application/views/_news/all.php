

    <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  

        <?php alert(); ?>        

          <div class="panel panel-default">

            <div class="panel-heading">

              <h4>

                News

                <span style="float: right;">

                  <a class="btn btn-primary" style="margin:-5px;" href="<?php echo base_url() ?>news/add">
                    Add new
                  </a>
                </span>
              </h4>

            </div>

            <div class="table-responsive">

            <table class="table table-striped">

              <thead>

                <tr>                  

                  <th>Title</th>

                  <th>Heading</th>

                  <th>Created</th>

                  <th>Action</th>

                </tr>

              </thead>

              <tbody>

                <?php if ($news): foreach ($news as $row) { ?>

                <tr>

                  <td><?php echo $row->title ?></td>

                  <td><?php echo $row->heading ?></td>                                    

                  <td><?php echo date('m/d/Y', strtotime($row->created)); ?></td>                                    

                  <td>

                    <a href="<?php echo base_url() ?>news/edit/<?php echo $row->slug ?>"><i class="glyphicon glyphicon-pencil"></i></a>

                         &nbsp;&nbsp;&nbsp;  

                         <a onclick="return confirm('Are you sure?')" href="<?php echo base_url() ?>news/delete/<?php echo $row->slug ?>"><i class="glyphicon glyphicon-remove"></i></a>

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