    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('admin/sidebar'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <?php echo alert(); ?>          

          <div class="panel panel-default">

            <div class="panel-heading">

              <h3>View Appointment</h3>

            </div>

            <div class="row">              

              <div class="col-sm-11 col-md-10 main">                             

                  <div class="form-group">
                    <label for="">For - <?php if($detail->type == '1') { echo "Wardrobe tune-up"; } elseif($detail->type == '2') { echo "Styling"; } elseif($detail->type == '3') { echo "Personal Shopping"; } else { echo "Consultation"; } ?></label>                                                       
                  </div>
                  <div class="form-group">
                    <label for="">Name - <?php echo ucfirst($detail->firstname.' '.$detail->lastname); ?></label>                                                       
                  </div>
                  <div class="form-group">
                    <label for="">Email - <?php echo ucfirst($detail->email); ?></label>                                                       
                  </div>
                  <div class="form-group">
                    <label for="">Phone - <?php echo ucfirst($detail->phone); ?></label>                                                       
                  </div>
                  <div class="form-group">
                    <label for="">Consultation Method - <?php echo ucfirst($detail->consultation_method); ?></label>                                                       
                  </div>
                  <div class="form-group">
                    <label for="">Preferred Date - <?php echo ucfirst($detail->preferred_date); ?></label>                                                       
                  </div>                  

              </div>

            

            </div>

            

          </div>



          

        </div>

      </div>

    </div>



    