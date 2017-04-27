<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Admin | Section </title>
  <?php include_once('static/head.php'); ?>
    <style type="text/css">
        .chk{
            border:thin solid blue;
        }
        
        .background{
            background-image: url('<?= base_url($scPic); ?>');
            background-repeat: no-repeat; 
/*             background-size: cover;
             */
             background-size: 150px;
/*             background-position: center;
         */
            background-position: top-left;        
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

                <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel">
                                <header class="panel-heading">
                                    <b> Section </b>

                                </header>

                                <div class="panel-body table-responsive">
                                <button type="button" class="btn btn-primary col-md-push-1 customBtn"> <span class="fa fa-plus"></span> &nbsp Add Section </button>

                                    <div class="box-tools m-b-15">
                                        <div class="input-group">
                                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- section table -->
                                    <table class="table table-hover" id="tblSec1">
                                    </table>

                                    <!-- pagination -->
                                    <div class="pagination pagination-sm pull-right">
                                        <ul class="pagination">
                                            <li id="minus"><a href="#">«</a></li>
                                            <li><a href="#"> &nbsp </a></li>
                                            <li id="plus"><a href="#">»</a></li>
                                        </ul>
                                    </div>
                                </div><!-- /.box-body -->
                                
                            </div><!-- /.box -->
                        </div>
                    </div>
                <!-- row end -->
            </div>
        </div><!-- ./wrapper -->
    </section><!-- ./content -->
  </div><!-- ./right-side -->
    <?php include_once('static/foot.php') ?>
    <?php include_once('static/adminjs.php'); ?>
    
    <script>
    //cacheVar
    var $tableSec1 = $("#tblSec1");

    //ajaxVar
    var url;
    var Currntlimit = 5;
    function getTableSec(limit = 5){            
        Currntlimit = limit;
        url = "<?= site_url('index.php/AdminSection/TableSec'); ?>/"+limit;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
/*                data: {param1: 'value1'},
*/            
            timeOut:2000,
            beforeSend:function(){
                //alert('Loading...');
                $tableSec1.html("<center> <h3>Loading ...</h3> </center>");
            }
        })
        .done(function(response) {
            console.log("success");
            $tableSec1.html(response);
        })
        .fail(function(res) {
             console.log(res, "error");
        });
    }

    // app var for init()
    var app = {

        //kada pag call ko kadi function na adi mig DagDag ahh limit niya
        init:function(){
            
            //pagination
            $("li#minus").unbind().click(function(){
                //alert("Ajax + 5 record Row");
                $tableSec1.empty();
                getTableSec(Currntlimit + 5);
            }); 

            $("li#plus").unbind().click(function(){
                //alert("Ajax - 5 record Row");
                $tableSec1.empty();
                getTableSec(Currntlimit - 5);
            });
            
        },
    }


    $(document).ready(function() {
        getTableSec();
        app.init();
    });
    </script>
</body> 
</html>