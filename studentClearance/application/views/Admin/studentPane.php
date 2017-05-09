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
       $("#secSubTbody").empty();
       $ModalTitle.text('New Student');
       $("button#btnSecSave").text('Save Student');

       // make the LRN Number using javascript function
       $LRN.val(getRandomInt(100000000000, 1000000000000));
       $LRN.attr('readonly', true);

       var crntLRN = $LRN.val();
       // hidden Pass
       $("#studPass").val(crntLRN.substr(crntLRN.length - 4));

        // disabled readonly property
        $FormSec.find("#secCode").removeAttr('readonly');
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


      function saveData() {
        alert("This is the add bew student function");

        if (method == 'add') {
            // ajax request for the student adding
            url = "<?= site_url('index.php/AdminStudent/saveStudent') ?>/add";

            data = $FormSec.serializeArray();

            console.log(data);

            $.post(url, data, function(res){
              res = $.parseJSON(res);

              console.log(res.status);
            })
        }
        else{

        }

      }

      $(document).ready(function() {
          sectionListDrop();
          $("#studMI").on('focus', function(evt){
            evt.preventDefault();
            $(this).val("");
          })
          $("#studMI").on('blur', function(evt){
            evt.preventDefault();
            $(this).val("-");
          })

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
    </script>
</body> 
</html>