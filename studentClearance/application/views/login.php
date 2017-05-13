<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> SC | Login </title>
	<?php include_once('Admin/static/head.php'); ?>
	<!-- custom css below -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/css/custom/teacher.css'); ?>">

  <!-- bootstrap validator -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrapValidator/dist/css/bootstrapValidator.css'); ?>">

    <style type="text/css">

        /* checking css */

        .hideIt{
            display: none;
        }
        .chk{
            border:thin solid blue;
        }

        /**/
        .strpRow:hover{
            background-color: #E9BFC3;
            cursor: pointer;
        }

        .btn-danger{
            padding: 5px !important;
        }

        .btnLogin{
            margin: 3px;
            width: 31%;
        }

        img{
            margin: 2%;
        }

        .fa-eye{
            cursor: pointer !important;
        }
    </style>
</head>
<body class="skin-black">
	<?php include('Admin/static/header.php') ?>
	
    	<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->

            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="right-side">

                <section class="content background">
                    
                    <!-- col-md-push-1 col-lg-push-1 -->
                    <div class="row">
                        <div class="col-md-7 col-lg-7 col-md-push-1">
                           <div class="panel">

                                <div class="panel-body">
                                    <div class="col-md-offset-3 col-lg-offset-3"> <img src="<?= base_url($scPic); ?>" style="margin-left: 47px;">
                                    </div>
                                    <form class="form-horizontal  col-lg-offset-2 col-md-offset-2 col-sm-12" role="form" id="frmLogin">
                                      <div class="form-group" id="usrNamePrt">
                                          <label class="col-lg-2 col-sm-2 control-label">Username</label>
                                          <div class="col-lg-5">
                                              <input type="text" class="form-control" id="usrName" name="Username" placeholder="Username" required>
                                              <p class="help-block"><span class="fa fa-warning fa-sm"></span> replace (<i>space</i>) with (_)</p>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="col-lg-2 col-sm-2 control-label">Password</label>
                                          <div class="col-lg-5">
                                              <input type="password" class="form-control" id="usrPass" name="Password" placeholder="Password" required>
                                              <!-- <span class="fa fa-eye fa-md pull-right" title="Show password">
                                              <input type="checkbox" id="shwPass">
                                              </span> -->
                                              <p class="help-block" id="studAdminHelp"><spanc class="fa fa-warning fa-sm"><i>Default:</i> Same from Username. </span></p>
                                              <p class="help-block" id="forStudent"><span class="fa fa-warning fa-sm"></span> Last 4 digit of LRN number</p>
                                          </div>
                                      </div>

                                        <label>Account Type </label><br>
                                          <label class="radio-inline">
                                            <input type="radio" name="usrType" value="admin" checked id="radAdmin">Admin
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="usrType" value="teacher" id="radTeacher">Teacher
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="usrType" value="student" id="radStudent">Student
                                          </label>
                                        <hr>
                                      <div class="form-group">
                                          <div class="col-lg-offset-5 col-lg-10">
                                              <button type="submit" class="btn btn-danger btn-lg btnLogin">Login</button>
                                              <!-- onclick="validateAccount()" -->
                                          </div>
                                      </div>
                                  </form>

                                </div>
                           </div>
                        </div>

                        <!-- <div class="col-md-5 col-lg-5 chk">
                            <h4> School notification here </h4>
                        </div> -->

                    </div>
                <!-- row end -->
                </section>


            </div>
        </div><!-- ./wrapper -->

	<?php include_once('Admin/static/foot.php') ?>
  <script src="<?= base_url('assets/bootstrapValidator/dist/bootstrap.validator.js'); ?>"></script>

    <script>
//cache 

    var $FORMLOGIN = $("#frmLogin");
    var $RADusr = $("#usrNamePrt");
    var $USRNAME = $("#usrName");
    var $USPASS = $("#usrPass");

//script  VAR
    var typeAcc = 'admin';
    var url;

        var app = {

            init:function(){
                $("#adminPic").hide();
                $(".dropdown-custom").hide();
                $("#forStudent").hide();
                

                // showing the input pass
                /*$('#frmLogin :checkbox').change(function() {
                    if (this.checked) {
                        $("#usrPass").attr('type','text');
                    } else {
                        $("#usrPass").attr('type','password');
                    }
                });*/


                //showing the animation of label
                $('input[type=radio][name=usrType]').change(function() {
                  if (this.value == 'admin') {
                      //alert('This is the Admin Radio FM');
                      $RADusr.show('slow');
                      $("#forStudent").hide('slow');
                      $("#studAdminHelp").show('slow');
                      typeAcc = 'admin';
                      $("#usrPass").attr('type', 'password');
                      $("#usrPass").removeAttr('maxLength');
                      $USRNAME.val("");
                      $USPASS.val("");

                  }

                  if (this.value == 'teacher') {
                      //alert('This is the Teacher Radio FM');
                      $RADusr.show('slow');
                      $("#forStudent").hide('slow');
                      $("#studAdminHelp").show('slow'); 
                      typeAcc = 'teacher';
                      $("#usrPass").attr('type', 'password');
                      $("#usrPass").removeAttr('maxLength');
                      $USPASS.val("");
                      $USRNAME.val("");

                  }

                  if(this.value == 'student'){
                      //alert('This is the Student Radio FM');
                      //$RADusr.hide('slow');
                      $("#studAdminHelp").hide('slow');
                      $("#forStudent").show('slow');
                      typeAcc = 'student';
                      /*$("#usrPass").attr({
                        'type':'Number'
                      });*/
                      $USPASS.val("");

                  }
                });
            }
        }

        $(document).ready(function(){
            app.init();

            $FORMLOGIN.bootstrap3Validate(function (e) {
              e.preventDefault();
              //$FORMLOGIN.attr('action', )
               url = "<?= site_url('index.php/login/validateaccount') ?>/"+typeAcc;
               data = $FORMLOGIN.serializeArray();
                if (typeAcc == 'admin') {
                  
                  $.post(url,  data, function(response){
                    response = $.parseJSON(response);
                    if (response.admin) {
                        url = "<?= site_url('index.php/adminstudent') ?>";
                        location.href = url;
                    }
                    else{
                      alert("Admin Account Incorrect!")
                    }
                  });
                }
                else if(typeAcc == 'teacher'){
                  console.log(data);
                  $.post(url,  data,function(response){
                    response = $.parseJSON(response);
                    if (response.teacher) {
                        url = "<?= site_url('index.php/teacher') ?>";
                        location.href = url;                   
                    }
                    else{
                      alert("Teacher Account Incorrect!")
                    }
                  });
                }
                else{
                  console.log(data);
                  $.post(url,  data,function(response){
                    response = $.parseJSON(response);
                    if (response.student) {
                        url = "<?= site_url('index.php/student') ?>";
                        location.href = url; 
                    }
                    else{
                      alert("Student Password Incorrect!")
                    }
                  });
                }

            });

        });
    </script>

</body>
</html>