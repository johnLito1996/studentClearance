<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Admin | Section </title>
  <?php include_once('static/head.php'); ?>
  
  <!-- custom datatables -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/custom/datatablesNew/css/dataTables.bootstrap.css'); ?>">

  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/custom/datatablesNew/css/jquery.dataTables.min.css'); ?>">

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
            margin-left: 2px;
            height: 334px;
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
                                    <b> Student </b>
                                    <button type="button" class="btn btn-success col-md-push-1 customBtn" onclick="addStudent()"> <span class="fa fa-plus" id="btnAddSec"></span> &nbsp New Student </button>
                                </header>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <!-- ./row end -->

                    <div class="row">                    
                         <div class="col-md-11 col-lg-11" style="margin-top: 7px;">
                            <div class="panel">
                                <div class="panel-body">
                                    <table class="table table-hover" id="tblStud1">
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <!--row2-->

                </section><!-- ./content -->
            </div><!-- ./right-side -->
    </div>
    <?php include('formModals/addStudent.php'); ?>
    <!-- ./frmModal -->

    <?php include_once('static/foot.php'); ?>
    <?php include_once('static/adminjs.php'); ?>

    <!-- custom for datatables -->
    <script src="<?= base_url('assets/custom/datatablesNew/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/custom/datatablesNew/js/dataTables.bootstrap.js'); ?>"></script>

    <script type="text/javascript">
      $("#hrefStudent").addClass('active');
      
// cache DOM 
      var $Modal = $("#myModal");
      var $ModalTitle = $("h4.modal-title").find('b'); 
      var $FormSec = $("form#studForm");

      var $LRN = $("#studLRN");
      var $StudLname = $("#studLName");
      var $StudFname = $("#studFName");
      var $StudMI= $("#studMI");
      var $Gender = $('input[name="Gender"]');
      var $secList = $("select#studSecList");
      var $Status = $("#studStatus");

// global VAR
      var method;  

// ajax VAR
      var url; 
      var data;

// extra functions 
    function getRandomInt(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }


// newStudent Modal
      function addStudent(){
        method = "add";

       $FormSec[0].reset();
       $Modal.modal({ 
            backdrop:"static",
            keyboard:false
       });
       $ModalTitle.text('New Student');
       $("button#btnSecSave").text('Save Student');

       $("div#conSelectSection").show();
       // make the LRN Number using javascript function
       $LRN.val(getRandomInt(100000000000, 1000000000000));
       $LRN.attr('readonly', true);

       var crntLRN = $LRN.val();
       // hidden Pass
       $("#studPass").val(crntLRN.substr(crntLRN.length - 4));

      }

      function sectionListDrop() {
        url = "<?= site_url('index.php/AdminSection/currentSecList') ?>/"+"studSecList";
        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'html',
        })
        .done(function(select) {
          console.log("success");
          $("select#studSecList").replaceWith(select);
        })
        .fail(function() {
          console.log("error");
        });
      }

      var secCodeEdit;
//editing student
      function editStudent(LRN) {
        // get the data of Student base in the view 
        // supply it to the DOM NODe
        url = "<?= site_url('index.php/AdminStudent/getStudentdata') ?>/"+LRN;

        $.get(url, function(data){
          data = $.parseJSON(data);

          method = "edit";

           $FormSec[0].reset();
           $Modal.modal({ 
                backdrop:"static",
                keyboard:false
           });
           $ModalTitle.text('Update Student');
           $("#btnStudSave").text("Update Student");

           // make the LRN Number using javascript function
           $LRN.val(data.dat[0].LRN_number);
           $LRN.attr('readonly', true);

           var crntLRN = $LRN.val();
           // hidden Pass
           $("#studPass").val(crntLRN.substr(crntLRN.length - 4));

           $StudLname.val(data.dat[0].Last_Name);
           $StudFname.val(data.dat[0].First_Name);
           $StudMI.val(data.dat[0].Initial);
            var crntGender = data.dat[0].Gender;
           
           if (crntGender == "Male") {
               $("#radMale").prop('checked', 'true');
           }else{
              //radFemale
               $("#radFemale").prop('checked', 'true');

           }
           
           $("div#conSelectSection").hide();
/*           $("#studSecList").val();
*/           secCodeEdit = data.dat[0].Section_Code;

            $Status.val(data.dat[0].Status);
        })
      
      }

      function saveData() {

        if (method == 'add') {
            // ajax request for the student adding
            url = "<?= site_url('index.php/AdminStudent/saveStudent') ?>/add";

            data = $FormSec.serializeArray();

            console.log(data);

            $.post(url, data, function(res){
              res = $.parseJSON(res);

              console.log(res.status);

              if (res.status) {
                alert("Student Added");
                tblStudReload();
                $Modal.modal('hide');
              }
              else{
                alert("Some Error Occur");
              }

            })
        }
        else{

            //alert(method);
            data = $FormSec.serializeArray();
            data[7].value = secCodeEdit;

            url = "<?= site_url('index.php/AdminStudent/saveStudent') ?>/edit";

            $.post(url, data, function(res){
              res = $.parseJSON(res);

              console.log(res.status);
              alert("Student Record Updated");
              tblStudReload();
              $Modal.modal('hide');

            })

        }

      }

      var table;
      $(document).ready(function() {
          sectionListDrop();
          $("#studMI").on('focus', function(evt){
            evt.preventDefault();
            $(this).val("");
          })


          // datatable Student
          //datatables
          table = $("table#tblStud1").DataTable({

                  /*key:value pairs_ JSON formated*/
                  "bInfo" : false,
                  "processing":true,
                  "serverSide":true,
                  "order":[],
                  "ajax":{

                      "url":"<?php echo site_url('index.php/AdminStudent/getStudentList') ?>",
                      "type":"POST"
                  },//ajax propeties with object JSON data


                  "columnDefs": [
                      { 
                          "targets": [ -1 ], //last column
                          "orderable": false, //set not orderable
                      }
                  ], //datatables colomDefinition

                  "columns":[
                      {"title":'LRN NUMBER'},
                      {"title":'LAST NAME'},
                      {"title":'FIRST NAME '},
                      {"title":'INITIAL'},
                      {"title":'GENDER'},
                      {"title":'STATUS'},
                      {"title":'SECTION CODE'},
                      {"title":'Action'}
                      
                  ]

              });

          // delegation in the student classmates part
          $("div#conSelectSection").on('change', 'select#studSecList', function(evt){
            evt.preventDefault();
              $ULClassmates = $("ul#classmatesList");
              $ULClassmates.empty();
              var crntSec = $(this).val();
              // ajax get call and append it to the ul in the classmates
              url = "<?= site_url('index.php/AdminStudent/getClassMates')?>/"+crntSec;
              $.get(url, function(lis){
                $ULClassmates.append(lis);

                var total = $ULClassmates.find('li').length;
                $("#totlClassMates").text(total);
              });


          });
      });


      //reloading the datatables
      function tblStudReload() {
        table.ajax.reload(null,false);
      }
    </script>
</body> 
</html>