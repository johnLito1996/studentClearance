<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Admin | Teacher </title>
	<?php include_once('static/head.php'); ?>
	<!-- custom css below -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/custom/css/utilityCss.css'); ?>">
    <style type="text/css">
        .chk{
            border:thin solid blue;
        }
        
        .background{
            background-image: url('<?= base_url($scPic); ?>');
            background-repeat: no-repeat; 
/*             background-size: cover;
             */
             background-size: 100px;
/*             background-position: center;
         */
            background-position: top-left;        
        }

        .scroll{
            height: 450px; 
            overflow: auto;
            margin-left: -37px;
            margin-right: 5px;>
        }

        .list-group-item:hover{
            background-color: #AED39E !important;
        }

        .hide{
            display:none;
        }

        .displayLine{
          display: inline;
        }
        
    </style>
</head>
<body class="skin-black">
	<?php include('static/header.php') ?>
	
	<div class="wrapper row-offcanvas row-offcanvas-left">
      <!-- Left side column. contains the logo and sidebar -->
      <?php include('static/sidebar.php'); ?>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="right-side">

        <!-- Main content -->
        <section class="content background">

          <div class="row">
              <div class="col-xs-12 col-md-12 col-md-push-1">
                  <div class="panel">
                      <section class="panel general">
                          <header class="panel-heading tab-bg-dark-navy-blue">
                              <ul class="nav nav-tabs">
                                  <li class="active">
                                      <a data-toggle="tab" href="#cAdmin"> <b>Create Admin</b> </a>
                                  </li>
                                  <li>
                                     <a data-toggle="tab" href="#cAdminChangepass"> <b>Change Password</b> </a>
                                  </li>
                              </ul>
                          </header>
                      <div class="panel-body">
                      <div class="tab-content">
                          <div id="cAdmin" class="tab-pane active">
                            <div class="row">

                              <div class="col-lg-11 col-md-11 col-sm-11">
                                <section class="panel">

                                  <div class="panel-body">
                                        
                                    <table class="table table-bordered" id="tblAdminAcc">
                                      
                                      <thead>
                                      <tr>
                                          <th> <b>#</b> </th>
                                          <th> <b>Username</b> </th>
                                          <th> <b>Password</b> </th>
                                          <th> <b>Status</b> </th>
                                          <th> <b>Action</b> </th>
                                      </tr>
                                      </thead>

                                      <tbody id="tbodyAdmin">
                                          
                                      </tbody>

                                      
                                    </table>
                                    <!-- ./table -->

                                      <hr>

                                    <div class="col-lg-7">
                                    <section class="panel">
                                      <header class="panel-heading">
                                          <b> new admin form </b>
                                      </header>

                                      <div class="panel-body">
                                          <form role="form" id="frmAdmin" method="POST">
                                              <div class="form-group">
                                                  <label for="nUsername"> Username </label>
                                                  <input type="email" class="form-control" name="UserName" id="nUsername" placeholder="Username" required>
                                              </div>
                                              <div class="form-group">
                                                  <label for="nPass">Password</label>
                                                  <input type="password" class="form-control" name="Password"  id="nPass" placeholder="Password" required>
                                              </div>
                                              <div class="form-group">
                                                  <label for="cnPass" style="display: inline;"> Confirm Password </label>
                                                  <input type="password" class="form-control" name=""  id="cnPass" placeholder="Password" required>
                                              </div>
                                          </form>
                                          <button type="button" class="btn btn-info" onclick="submitAdmin()"> <span class="fa fa-user-plus" ></span> <b>Create</b> </button>
                                      </div>
                                    </section>
                                    </div>
                                  </div>
                                  <!-- ./panel-body -->
                                </section>
                                <!-- ./panel -->
                              </div>
                              <!-- ./col -->
                            </div>
                            <!-- ./row -->
                          </div>

                          <div id="cAdminChangepass" class="tab-pane">
                            <div class="row">
                              <div class="col-lg-11 col-md-11 col-sm-11">
                                <section class="panel">

                                  <div class="panel-body">

                                    <div class="col-lg-7">
                                    <section class="panel">

                                      <div class="panel-body">
                                          <form role="form" id="frmChangePass" method="POST">
                                              <fieldset>
                                              <legend>Change Password</legend>

                                                <div class="form-group">
                                                    <div class="row">
                                                    <div class="col-md-7 col-sm-7">
                                                    <label class="displayLine">Old Password</label>
                                                    <input type="password" class="form-control" id="oldPass" placeholder="Old Password" required>
                                                    </div>
                                                    </div>
                                                </div>                                  
                                                <div class="form-group">
                                                    <div class="row">
                                                    <div class="col-md-7 col-sm-7">
                                                    <label class="displayLine">New Password</label>
                                                    <input type="password" class="form-control" id="newPass" placeholder="New Password" required>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                    <div class="col-md-7 col-sm-7">
                                                    <label class="displayLine">Confirm Password</label>
                                                    <input type="password" class="form-control" id="confirmPass" placeholder="Confirm Password" name="Password" required>
                                                    </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-info" onclick="changeAdminPass()">Change Password</button>
                                             </fieldset>
                                            </form>
                                      </div>
                                    </section>
                                    </div>
                                  </div>
                                  <!-- ./panel-body -->
                                </section>
                                <!-- ./panel -->
                              </div>
                              <!-- ./col -->
                            </div>
                            <!-- ./row -->
                          </div>                          
                      
                      </div>
                      <!-- ./tabcontent -->
                      </div>
                      </section> 
                  </div>
                  <!-- /.box -->
              </div>
          </div>
          <!-- ./row2 -->
        </section><!-- /.content -->
      </div>
    </div><!-- ./wrapper -->

	<?php include_once('static/foot.php') ?>

    <!-- fetch the admin data -->
    <?php include_once('static/adminjs.php'); ?>

    <script>
//cache VAR
        var $TBLACC = $("table#tblAdminAcc").find('tbody#tbodyAdmin');
        var $FRMAdmin = $("#frmAdmin");

//ajax Variable 
        var url;
        var data;

// changingPass
        var oldpass;
        function getAdminAcc() {
            
            url = "<?= site_url('index.php/AdminUtility/getAdminAccount') ?>";
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
            })
            .done(function(trs) {
                console.log("success");
                $TBLACC.append(trs);
            })
            .fail(function() {
                console.log("error");
            });
            
        }

var $NewPass = $("#nPass");
var $OldPass = $("#cnPass");
var $NewUsername = $("#nUsername");
        function submitAdmin() {
            data = $FRMAdmin.serializeArray();
      
            if (($NewUsername.val() == "") || ($NewPass.val()) == "" || ($OldPass.val() == "")) {
              alert(' Field is empty');
            }
            else{//checking empty

                if ($NewPass.val() != $OldPass.val()) {
                    alert('Password Not Match \n Try Again!')
                }
                else{
                    
                    url = "<?= site_url('index.php/AdminUtility/saveAdmin') ?>"
                    $.post(url, data, function(data, textStatus, xhr) {

                        data = $.parseJSON(data);
                        if (data.status) {
                            alert('Account Created');
                            $TBLACC.empty();
                            getAdminAcc();
                        }
                        else{
                            alert('error!');
                        }
                    });
                }
            } //else
        }

        function getOldPass() {
          var url = "<?= site_url('index.php/AdminTeacher/AdminDat'); ?>";
            $.get(url, function(data){
              data = $.parseJSON(data);
              oldPass = data.data[0].Password;
              console.log(oldPass);
              /*$("#oldAdminPass").text(oldPass);*/
            });
        }

        function changeAdminPass() {
          //alert(oldPass); ok 
          if ($("#oldPass").val() === oldPass) {
            var newPass = $("#newPass").val();
              if ( newPass === $("#confirmPass").val()) {

                var usrname = $("#adminName").text();
                /*data = {
                  username:usrname,
                  password:newPass
                }*/

            url = "<?= site_url('index.php/AdminUtility/changeAdminPass') ?>/"+usrname+"/"+newPass;
                $.post(url, function(res){
                  res = $.parseJSON(res);
                  //console.log(res);
                  if (res.status) {
                    alert('Password Changed');
                    window.location.reload();
                  }
                })

              }
              else{
                alert('New and Old password not match');
              }
            }
            else{
              alert('Incorrect Old Password!');
            }
        }

        $(document).ready(function(){
            getAdminAcc();
            getOldPass();
            //delegate on status changing
            $TBLACC.on('click', 'button#btnDeactivate', function (evt) {
                evt.preventDefault();
                var crntBtn = $(this);
                var crntstatus = crntBtn.data('crntstatus');
                var crntusrname = crntBtn.data('crntusrname');
                var statBadge = $(this).closest('tr').find('td > center > span.badge');
                
                url = "<?= site_url('index.php/AdminUtility/changeStatusAdmin'); ?>/"+crntusrname+"/"+crntstatus;
                
                if (crntstatus === 'active') {
                  //console.log('change to diactive badge and active button');
                  crntBtn.data('crntstatus', 'inactive');
                  statBadge.removeClass('bg-green').addClass('bg-red').text('In Active');
                  crntBtn.removeClass('btn-danger').addClass('btn-success').text('Activate');

                  $.get(url, function(res){
                    console.log(res);
                  });
                }

                if(crntstatus === 'inactive'){
                  //console.log('change to active badge and inactive button');
                  crntBtn.data('crntstatus', 'active');
                  statBadge.removeClass('bg-red').addClass('bg-green').text('Active');
                  crntBtn.removeClass('btn-success').addClass('btn-danger').text('Diactivate Account');

                  $.get(url, function(res){
                    console.log(res);
                  });
                }
            });

        })
    </script>

</body>
</html>