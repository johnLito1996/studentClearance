<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> TEACHER | HOME </title>
	<?php include_once('static/head.php'); ?>
	
    <!-- datatables css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/custom/datatablesNew/css/datatables.bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/custom/datatablesNew/css/jquery.datatables.min.css'); ?>">

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/css/custom/teacher.css'); ?>">
    <?php include('static/common_css.php'); ?>    
</head>
<body class="skin-black">
	<?php include('static/header.php') ?>
	
	<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php //include('static/sidebar.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="right-side">

                <section class="content background">
                    
                    <code id="teachID" class="hideIt"><?= 
                    $_SESSION['teacherLoginID']; 
                    ?></code>
                    <div class="row">
                        <div class="col-md-10 col-lg-10 col-md-push-1 col-lg-push-1">
                        <div class="panel">
                            <header class="panel-heading">
                                <b> <span class="fa fa-lg fa-graduation-cap"></span>Section List</b>
                            </header>

                            <div class="panel-body">
                                <table class="table table-striped" cellpadding="10" id="tblTeachSection">
                                    <thead>
                                        <tr>
                                            <th>SECTION CODE</th>
                                            <th>TRACK</th>
                                            <th>STRAND</th>
                                            <th>ROOM NUMBER</th>
                                            <th>GRADE LEVEL</th>
                                            <th>SCHEDULE</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div><!-- /.panel-body -->
                        </div><!-- /.panel -->
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-md-push-1 col-lg-push-1">
                           <div class="panel">
                               <header class="panel-heading">
                                  <b> <span class="fa fa-list"></span> &nbsp; Clearance Panel </b>
                               </header>

                           <div class="panel-body table-responsive">

                              <div class="row">

                              </div>

                              <form id="frmStudRemarks" name="frmStudRemarks" method="POST">
                                <div id="divRmkStudents">
                                    <div class="row">
                                      <div class="col-sm-12">
                                          <p> 
                                          <b style="color: #941518;border-bottom: thin solid;" id="secName">section</b> </p>
                                      </div>
                                    </div>

                                  <div class="row">
                                    
                                    <div class="col-sm-6">
                                      <button class="btn btn-info pull-right" title="Search via Student" id="btnSecStuds" onclick="secStud()">
                                      <span class="fa fa-user fa-md"> </span> &nbsp;  Individual </button>
                                    </div>

                                    <div class="col-sm-6">
                                      <button class="btn btn-warning" style="display: inline;" title="Search via Subjects" id="btnSecSubs" onclick="getsecSub()"><span class="fa fa-user-plus"></span> &nbsp; Subjects </button>
                                    </div>
                                  </div>
                                    <br>

                                    <div class="row" id="selectStudentDrop">
                                      <div class="col-sm-12">
                                      <label style="display: inline;" id="lblSearch"> Student Name: </label>
                                      <select name="sectionStudents" id="secStuds">
                                        <option value="sample"> Click Section </option>
                                        <option value="sample"> Click Section </option>
                                        <option value="sample"> Click Section </option>
                                        <option value="sample"> Click Section </option>
                                      </select>
                                      </div>
                                    </div>

                                </div><hr><table class="table table-hover" border="1">

                                 <!--ajaxDiv-->
                                    
                                      <thead>
                                        <tr>
                                          <th> <b id="titleChange">Remarks List</b> </th>
                                          <th> <b>Category</b> </th>
                                          <th style="text-align: center;"> <b>Remarks</b> </th>
                                        </tr>
                                      </thead>

                                      <tbody id="studListRemarks">
                                        <tr>
                                          <td> sample subjects 2</td>
                                          <td> Category </td>
                                          <td> 
                                              <div class="col-sm-4"><input type="radio" name="Status" id="statOK"> OK </div>
                                              <div class="col-sm-4"><input type="radio" name="Status" id="statINC"> INC </div>
                                              <div class="col-sm-4"><input type="radio" name="Status" id="statDrp"> DROP </div>
                                          </td>
                                        </tr>
                                  </tbody>
                                 
                              </table>
                               </form>  
                                <button type="submit" class="btn btn-primary col-md-push-1 customBtn pull-right" style="background-color:#39435c; margin-top:2%;" onclick="editStudRemarks()"> <span class="fa fa-save fa-sm"></span> &nbsp; Save Remarks </button>

                            </div>


                           </div>
                            <!-- ./panel -->
                        </div>
                    </div>
                <!-- row end -->
                </section>


            </div>
        </div><!-- ./wrapper -->

	<?php include_once('static/foot.php') ?>

    <!-- datatables js -->
    <script src="<?= base_url('assets/custom/datatablesNew/js/jquery.datatables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/custom/datatablesNew/js/datatables.bootstrap.js'); ?>"></script>

    <?php include('home/home_js.php'); ?>
    <?php include('clearance/sectionremarks_js.php'); ?>
</body>
</html>