<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> TEACHER | HOME </title>
    <?php include_once('static/head.php'); ?>
    
    <?php include('static/common_css.php'); ?>    
</head>
<body class="skin-black">
    <?php include('static/header.php') ?>
    
    <div class="wrapper row-offcanvas row-offcanvas-left">

            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="right-side">

                <section class="content background">
                    
                    <code id="teachID" class="hideIt"><?= 
                    $_SESSION['teacherLoginID']; 
                    ?></code>
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-md-push-2 col-lg-push-2">
                        <div class="panel">
                            <header class="panel-heading">
                                <b> <span class="fa fa-lg fa-user"></span> &nbsp Teacher Profile </b>
                            </header>

                            <div class="panel-body">
                                
                                <div class="row">
                                  <div class="col-lg-8 col-lg-push-2 col-md-8 col-md-push-2">
                                        <section class="panel">
                                            <div class="panel-body">
                                                <form role="form">                                
                                              <div class="form-group">
                                               <div class="row">              
                                                 <div class="col-md-4 col-sm-4">
                                                  <label> Teacher ID: </label>
                                                  <input type="text" class="form-control cusInput" name="Teacher_ID" id="teachIDForm"readonly>
                                                   </div>
                                                   <div class="col-md-push-3 col-md-4 col-sm-4">
                                                    <label for="teachDep"> Department:</label>
                                                    <input type="text" name="Department" id="teachDep" class="form-control cusInput" readonly>
                                                   </div>
                                                 </div>
                                                </div>

                                                <div class="form-group">
                                                  <div class="row">
                                                    <div class="col-md-7 col-sm-7">
                                                      <label for="tLname"> Last Name: </label>
                                                        <input type="text" class="form-control cusInput" name="Teacher_Last_Name" id="tLname" readonly>
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="form-group">
                                                  <div class="row">
                                                    <div class="col-md-7 col-sm-7">
                                                      <label for="tFname"> First Name: </label>
                                                        <input type="text" class="form-control cusInput" name="Teacher_First_Name" id="tFname" readonly>
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="form-group">
                                                  <label for="tMI"> M.I </label>
                                                  <input type="text" class="form-control cusInput" style="width: 15%; text-transform: uppercase;" name="Teacher_MiddleInitial" id="tMI" maxlength="2" readonly>
                                                </div>

                                                <div class="form-group">
                                                  <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                      <label for=""> Gender:</label>
                                                       <input type="text" class="form-control cusInput" style="width: 41%; text-transform: uppercase;" name="Gender" id="tGender" readonly>
                                                    </div>
                                                  </div>
                                                </div>
                                              </form>
                                            </div>
                                        </section>
                                    </div>
                            </div>
                            <!-- ./row -->

                            <div class="row">
                              <div class="col-lg-8 col-lg-push-2 col-md-8 col-md-push-2 ">
                                      <section class="panel">
                                          <div class="panel-body">
                                              <form role="form" id="frmChangePass">
                                              <fieldset>
                                              <legend>Change Password</legend>

                                                <div class="form-group">
                                                  <div class="row">
                                                    <div class="col-md-7 col-sm-7">
                                                      <label for="tLname"> Username </label>
                                                        <input type="text" class="form-control cusInput" id="cUsername" readonly>
                                                    </div>
                                                  </div>
                                                </div>

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
                                                <!-- <div class="form-group">
                                                    <label class="displayLine">Change Picture</label>
                                                    <input type="file" id="changePicteacher" name="Teacher_Profile">
                                                </div> -->
                                                <button type="submit" class="btn btn-info">Save Change</button>

                                                <!-- onclick="saveTeacherDat()" -->
                                             </fieldset>
                                            </form>
                                          </div>
                                      </section>
                                  </div>
                            </div>
                          <!-- ./row -->
                        </div>
                      </div>
                    </div>
                </section>
            </div>
        </div><!-- ./wrapper -->

    <?php include_once('static/foot.php') ?>
    <script>
// cache
    var $teachPic = $("#teacherPic");
    var $teachName = $("#teacherName");
//form    
    var $teachIDForm = $("#teachIDForm");
    var $teachDep = $("#teachDep");
    var $tLname = $("#tLname");
    var $tFname = $("#tFname");
    var $tMI = $("#tMI");
    var $tGender = $("#tGender");
    var $cUsername = $("#cUsername");
    var oldPass;
//ajax VAR
    var url; 
    var data;

//constant DVAR
    var crntTeachID = $("#teachID").text();


        function getTeacherDatProfile(){
            url = "<?= site_url('index.php/teacher/crntloginteachdat') ?>/"+crntTeachID;
            $.get(url, function(tDat){
                tDat = $.parseJSON(tDat);

                console.log(tDat);
                
                var dataOutTeach = tDat.teacherDAt[0];
                var fullName = dataOutTeach.Teacher_Last_Name + ", " + dataOutTeach.Teacher_First_Name;
                $teachName.text(fullName);
                var picTure = "<?= base_url() ?>"+dataOutTeach.Teacher_Profile;
                $teachPic.attr('src', picTure);

                $teachIDForm.val(crntTeachID);
                $teachDep.val(dataOutTeach.Department);
                $tLname.val(dataOutTeach.Teacher_Last_Name);
                $tFname.val(dataOutTeach.Teacher_First_Name);
                $tMI.val(dataOutTeach.Teacher_MiddleInitial);
                $tGender.val(dataOutTeach.Gender);
                $cUsername.val(dataOutTeach.Username);

                oldPass = dataOutTeach.Password;
               // alert('This is inside the getTeacherDatProfile');
            });
        }

// cache dom for changePass
  var $oldPass = $("#oldPass");
  var $newPass = $("#newPass");
  var $confirmPass = $("#confirmPass");
  var $changeProfileFrm = $("form#frmChangePass");
      

      $(document).ready(function() {
        getTeacherDatProfile();
        $changeProfileFrm.on('submit', function(e){
          e.preventDefault();

          data = $changeProfileFrm.serializeArray();

            if ($oldPass.val() === oldPass) {
              if ($newPass.val() === $confirmPass.val()) {

                url = "<?= site_url('index.php/teacher/savechangeteacherprofile') ?>/"+crntTeachID;
                $.ajax({
                  url: url,
                  type: 'POST',
                  dataType: 'json',
                  data: data,
                })
                .done(function(data) {
                  console.log("success");
                  //data = $.parseJSON(data);
                  if (data.status) {
                    alert('Teacher Password Change');
                    url = "<?= site_url('index.php/login'); ?>";
                    window.location.href = url;
                  }
                })
                .fail(function() {
                  console.log("error");
                });
                
              }
              else{
                alert('New and Old password not match');
              }
            }
            else{
              alert('Incorrect Old Password!');
            }
        })
      });
    </script>
</body>
</html>