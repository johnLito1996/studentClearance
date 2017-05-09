<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Admin | Login </title>
	<?php include_once('Admin/static/head.php'); ?>
	<!-- custom css below -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/css/custom/teacher.css'); ?>">
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
                        <div class="col-md-7 col-lg-7">
                           <div class="panel">

                                <div class="panel-body">
                                    <div class="col-md-offset-3 col-lg-offset-3"> <img src="<?= base_url($scPic); ?>"></div>
                                    <form class="form-horizontal  col-lg-offset-2 col-md-offset-2" role="form" id="frmLogin">
                                      <div class="form-group">
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
                                              <span class="fa fa-eye fa-md pull-right" title="Show password">
                                              <input type="checkbox" id="shwPass">
                                              </span>
                                              <p class="help-block"><spanc class="fa fa-warning fa-sm"><i>Default:</i> Same from Username. </span></p>
                                          </div>
                                      </div>

                                        <label>Account Type </label><br>
                                          <label class="radio-inline">
                                            <input type="radio" name="usrType" value="admin" checked>Admin
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="usrType" value="teacher">Teacher
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="usrType" value="student">Student
                                          </label>
                                        <hr>
                                      <div class="form-group">
                                          <div class="col-lg-offset-5 col-lg-10">
                                              <button type="submit" class="btn btn-danger btn-lg btnLogin">Login</button>
                                          </div>
                                      </div>
                                  </form>

                                </div>
                           </div>
                        </div>

                        <div class="col-md-5 col-lg-5 chk">
                        
                            <h4> School notification here </h4>

                        </div>

                    </div>
                <!-- row end -->
                </section>


            </div>
        </div><!-- ./wrapper -->

	<?php include_once('Admin/static/foot.php') ?>
    <script>

        var app = {

            init:function(){
                $("#adminPic").hide();
                $(".dropdown-custom").hide();

                var url = "<?= site_url('index.php/Login/validate'); ?>";
                $("form#frmLogin").on('submit', function(evt){
                    evt.preventDefault();
                    var data = $("form#frmLogin").serialize();
                    console.log(data);
                    $.ajax({
                        url:url,
                        type:"POST",
                        dataType:"text",
                        data:data,
                            success:function(response){
                                expr = /Not/;  // no quotes here
                                var evaluate = expr.test(response); // true agko Not
                                //alert(typeof(response));
                                if (evaluate) {
                                    var type = response.slice(3);
                                    alert("Wrong " + type + " Account");

                                }
                                else{
                                   /* alert("Welcome " + response);*/
                                   url = "<?= site_url('index.php/AdminTeacher'); ?>";
                                    location.href = url;
                                }
                            },
                            error:function(request, errType, errMsg){
                                alert('Error: ' + errType + 'Message: ' + errMsg);
                            }
                        });
                });

                // showing the input pass
                $('#frmLogin :checkbox').change(function() {
                    if (this.checked) {
                        $("#usrPass").attr('type','text');
                    } else {
                        $("#usrPass").attr('type','password');
                    }
                });
            }
        } 
        $(document).ready(function(){
            app.init();
        });
    </script>

</body>
</html>