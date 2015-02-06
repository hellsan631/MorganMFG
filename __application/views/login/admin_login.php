<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta name="description" content="Mca ignou major project"> -->
    <!-- <meta name="author" content="Prince"> -->
    <!-- <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/favicon.png"> -->

    <title> <?php echo PROJECT_NAME ?> | Admin | Login</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url() ?>assets/bootstrap/css/signin.css" rel="stylesheet">
    
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .ci_alert{
        position: fixed !important;
        top: 0px !important;
        left: 0px !important;
        width: 100% !important;
        text-align: center !important;
      }
    </style>
  </head>

  <body>

    <div class="container">

      <?php alert(); ?>

      <?php echo form_open(current_url(), array('class'=>"form-signin", 'role'=>"form")); ?>
        <h2 class="form-signin-heading">Please Login</h2>
        <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <a style="display:none" id="forget_password" href="javascript:void(0)">Forget Password</a>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
      </form>

    </div>
  </body>
</html>

<script type="text/javascript">
  $(document).ready(function()
  {
     $('#forget_password').click(function()
     {
         $('#error_msg').hide();
         $('#success_msg').hide();
         $('#forget_pass_modal').modal();
     });


  });
    function submit_email()
    {
      email = $('input[name=forget_email]').val();
      var atpos = email.indexOf("@");
      var dotpos = email.lastIndexOf(".");
      if(email=="")
      {
        $('#success_msg').fadeOut('fast');
        $('#error_msg').html("Please Enter Your Email address");
        $('#error_msg').fadeIn('slow');
        return false;
      }
      else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) 
      {
        $('#success_msg').fadeOut('fast');
        $('#error_msg').html("Not a valid e-mail address");
        $('#error_msg').fadeIn('slow');
        return false;
      }
      else
      {
        $.ajax
        ({
           type:"post",
           url:"<?php echo base_url() ?>login/forget_password",
           data:{email:email},
           success:function(res)
           {
              response = $.parseJSON(res);
              if(response.status=="error")
              {
                    $('#success_msg').fadeOut('fast');
                    $('#error_msg').html(response.msg);
                    $('#error_msg').fadeIn('slow');
              }
              else if(response.status=="success")
              {
                    $('#error_msg').fadeOut('fast');
                    $('#success_msg').html(response.msg);
                    $('#success_msg').fadeIn('slow');
              }
           }
        });
      }
    }
</script>

<!-- Forget password modal starts -->
<div class="modal fade" id="forget_pass_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Please Enter Your Email Address</h4>
      </div>
          <div class="modal-body">
          <div id="error_msg" class="alert alert-danger"></div>
          <div id="success_msg"class="alert alert-success"></div>
            <input type="text" class="form-control" name="forget_email" placeholder="Please Enter Your Email address">
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="submit_email()" class="btn btn-primary">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Forget password modal Ends -->
