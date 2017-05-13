<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Admin | Section </title>
  <?php include_once('static/head.php'); ?>
  
  <!-- custom datatables -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/custom/datatablesnew/css/dataTables.bootstrap.css'); ?>">

  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/custom/datatablesnew/css/jquery.datatables.min.css'); ?>">

  <!-- custom css below -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/css/custom/teacher.css'); ?>">

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

        /* datatables overwrite */
        .dataTables_filter{
            margin-right: 30% !important;
        }

        /* capitalize data */
        .cpt{
            text-transform: capitalize;
        }

        /* uppercase fld */
        .upTxt{
          text-transform: uppercase;
        }
        /* scrolling od section subjects */
        .scroll{ 
            overflow: auto;
            margin-left: 13px;
        }

        .hideIt{
          display: none;
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

                <section  on class="content background container">
                    
                    <div class="row">
<!--                         <div class="col-xs-12">
                         -->                        
                         <div class=" col-md-offset-1 col-md-3 col-lg-3">
                            <div class="panel">
                                <header class="panel-heading">
                                    <b> Section </b>
                                    <button type="button" class="btn btn-primary col-md-push-1 customBtn" onclick="addSection()"> <span class="fa fa-plus" id="btnAddSec"></span> &nbsp Add Section </button>
                                </header>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <!-- ./row end -->

                    <div class="row">                    
                         <div class="col-md-12 col-lg-12" style="margin-top: 7px;">
                            <div class="panel">
                                <div class="panel-body">
                                    <table class="table table-hover" id="tblSec1">
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
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <!--row2-->

                    <!--wait until the student section is now ok -->
                    <div class="row">
                        <div class="col-md-8 col-lg-8">
                           <section class="panel">
                               <header class="panel-heading">
                                  <b> <span class="fa fa-list"></span> &nbsp Clearance Panel </b>
                               </header>

                           <div class="panel-body table-responsive">

                              <div class="row">

                              </div>

                              <form id="frmStudRemarks" name="frmStudRemarks" method="POST">
                                <table class="table table-hover" border="1">

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
                                      <span class="fa fa-user fa-md"> </span> &nbsp  Individual </button>
                                    </div>

                                    <div class="col-sm-6">
                                      <button class="btn btn-warning" style="display: inline;" title="Search via Subjects" id="btnSecSubs" onclick="getsecSub()"><span class="fa fa-user-plus"></span> &nbsp Subjects </button>
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

                                </div> <!--ajaxDiv-->
                                    <hr>
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
                                <button type="submit" class="btn btn-primary col-md-push-1 customBtn pull-right" style="background-color:#39435c; margin-top:2%;" onclick="editStudRemarks()"> <span class="fa fa-save fa-sm"></span> &nbsp Save Remarks </button>

                            </div>


                           </section>
                            <!-- ./panel -->
                        </div>
                    </div> 
                    <!-- ./row -->
                </section><!-- ./content -->
            </div><!-- ./right-side -->
    </div>
    <?php include('formModals/addSection.php'); ?>
    <!-- ./frmModal -->

    <?php include_once('static/foot.php') ?>
    <?php include_once('static/adminjs.php'); ?>
    
    <!-- sectionRemarks Process -->
    <?php include_once('sectionjsprt/sectionremarks_js.php'); ?>

    <!-- custom for datatables -->
    <script src="<?= base_url('assets/custom/datatablesnew/js/jquery.datatables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/custom/datatablesnew/js/datatables.bootstrap.js'); ?>"></script>
    
    <!-- section function currently -->
    <?php include_once('sectionjsprt/sectionfunctionjs.php') ?>
</body> 
</html>