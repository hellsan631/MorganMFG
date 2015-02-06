

    <div class="container-fluid">

      <div class="row">

        <?php $this->load->view('admin/sidebar'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  

        <?php alert(); ?>        

          <div class="panel panel-default">

            <div class="panel-heading">

              <h4>

                Page Contents

              </h4>

            </div>

            <div class="table-responsive">

            <table class="table table-striped">

              <thead>

                <tr>                  

                  <th>Title</th>

                  <th>Action</th>

                </tr>

              </thead>

              <tbody>

                <tr>
                  <td> Home Page Sub Headers </td>                                    
                  <td>
                    <a href="<?php echo base_url() ?>page_content/update_home_subheadings"><i class="glyphicon glyphicon-pencil"></i></a>
                  </td>
                </tr> 

                <tr>
                  <td> Contact Page Address </td>                                    
                  <td>
                    <a href="<?php echo base_url() ?>page_content/update_contact_address"><i class="glyphicon glyphicon-pencil"></i></a>
                  </td>
                </tr>               

                

              </tbody>

            </table>

            <div>

              

            </div>

          </div>

          </div>         

        </div>

      </div>

    </div>