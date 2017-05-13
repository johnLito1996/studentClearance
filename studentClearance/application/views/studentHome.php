<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> STUDENT | HOME </title>
	<?php include_once('Teacher/static/head.php'); ?>

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/css/custom/teacher.css'); ?>">
    <?php include('teacher/static/common_css.php'); ?>    
</head>
<body class="skin-black">
	<?php include('teacher/static/header.php') ?>
	
	<div class="wrapper row-offcanvas row-offcanvas-left">

            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="right-side">

                <section class="content background">
                    
                    <code id="student" class="hideIt"><?= 
                    $_SESSION['studentLoginID']; 
                    ?></code>
                    <div class="row">
                        <div class="col-md-7 col-lg-7 col-md-push-2 col-lg-push-2">
                        <div class="panel">
                            <header class="panel-heading">
                                <b> <span class="fa fa-lg fa-university"></span>Remarks List</b>
                            </header>

                            <div class="panel-body">
                            <div class="row" style="margin-bottom: 14px;">
                              <div class="col-sm-12">
                                <b style="color: #941518;border-bottom: thin solid;" id="secName">section</b>
                              </div>
                            </div>
                                <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th> REMARKS CODE </th>
                                            <th> CATEGORY </th>
                                            <th style="width: 40px">Status</th>
                                        </tr>
                                        </thead>

                                        <tbody id="remarksTBody">
                                        <tr>
                                            <td>#</td>
                                            <td>No Data</td>
                                            <td>No Data</td>
                                            <td>
                                            <!-- <span class="label label-success">OK</span> -->
                                            </td>
                                        </tr>
                                        </tbody>
                                        
                                    </table>
                            </div><!-- /.panel-body -->
                        </div><!-- /.panel -->
                    </div>
                    </div>

                </section>
            </div>
        </div><!-- ./wrapper -->
	<?php include_once('teacher/static/foot.php') ?>

  <script>

  function remarksStatus(status) {
    switch(status){

      case "OK":
      return `<span class="label label-success">OK</span>`;

      case "INC":
      return `<span class="label label-warning">INC</span>`;

      case "DRP":
      return `<span class="label label-danger">DROP</span>`;

      default:
      return `<span class="label label-info"> Un remarks </span>`;
    }

  }

//ajax VAr
var url;
var LRN = $("#student").text();
var $remarksTBody = $("#remarksTBody");
var section;

  function getStudRemarks(lrn, secCode) {
    $remarksTBody.empty();
      url ="<?= site_url('index.php/student/getsub_remarks') ?>/"+LRN+"/"+secCode;
      $.get(url, function(data){
        data = $.parseJSON(data);

          $.each(data.remarks, function(i, obj){
            var status = remarksStatus(obj.Status);
            var rowNum = (i+1);
            var trOw = `
                  <tr>
                  <td>`+rowNum+`</td>
                  <td>`+obj.Subject_Signatory_Code+`</td>
                  <td>`+obj.Category+`</td>
                  <td>`+status+`</td>
            `;
            $remarksTBody.append(trOw);
          });
      });
  }


  function getStudentData(){
    url = "<?= site_url('index.php/student/crntstuddat') ?>/"+LRN;
   // alert(LRN);
    $.get(url, function(data){
      data = $.parseJSON(data);

      var resultCtr = data.studDat.length;

      if(resultCtr === 0){

        alert('Student is Un enrolled');
      }
      else{
      var ref = data.studDat[0];
      var studName = ref.Last_Name+", "+ref.First_Name;
      $("#teacherName").text(studName);
      $("#teacherName").css('text-transform', 'capitalize');

      section = ref.Section_Code;
      $("#secName").text(section);

      getStudRemarks(LRN, section);
      }
    });
  }

   $(document).ready(function(){
       $("#teacherPic").addClass('hideIt');
       $("#profileLi").addClass('hideIt');

       getStudentData();

       setInterval(function () {
        getStudRemarks(LRN, section);
       }, 200000);
   });
  </script>
</body>
</html>