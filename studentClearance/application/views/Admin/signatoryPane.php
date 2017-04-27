<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Admin | Assignatory </title>
	<?php include_once('static/head.php'); ?>
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
             background-size: 150px;
/*             background-position: center;
         */
            background-position: top-left;        
        }

        .strpRow:hover{
            background-color: #E9BFC3;
            cursor: pointer;
        }

        .btn-danger{
            padding: 5px !important;
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

                <section class="content background">
                    
                    <div class="row">
                        <div class="col-md-7 col-lg-7 col-md-push-2 col-lg-push-2">
                        
                        <div class="panel">
                                <header class="panel-heading">
                                    <b>Assignatory List</b>
                                </header>

                                <div class="panel-body">
                                <button class="btn btn-primary col-md-push-1 customBtn" data-toggle="modal" href="#myModal" data-backdrop="static" data-keyboard="false">
                                    <i class="fa fa-plus"></i>
                                    Add Teacher
                                </button>

                                    <table class="table table-striped" cellpadding="10">

                                    </table>
                                </div><!-- /.panel-body -->

                                <!-- modal -->
                                <?php include('formModals/addAssignatory.php'); ?>
                            </div><!-- /.panel -->
                    </div>
                    </div>
                <!-- row end -->
                </section>


            </div>
        </div><!-- ./wrapper -->

	<?php include_once('static/foot.php') ?>
    <script>
    //cache
    var $table_striped = $("table.table-striped");
    var $assigForm = $("form#assigForm");
    var url;
    var col = `
            <tr>
                <th> <b>Code</b> </th>
                <th> <b>Description</b> </th>
                <th> Action </th>
            </tr>
    `;
        //table data
        function getAssigDat(){

            // upgrade the ajax loader
            url = "<?= site_url('index.php/AdminAssignatory/getAssigDat'); ?>";
            $.get(url, function(data){

                data = $.parseJSON(data);
                var outPut;

                $table_striped.prepend(col);
                $.each(data.data, function(i, obj){
                    /*console.log(i+1);
                    console.log(obj.Signatory_code);*/

                    outPut = `
                        <tr data-colId=`+i+` id=row`+i+` class="strpRow">
                            <td id="code">`+obj.Signatory_code+`</td>
                            <td>`+obj.Signatory_description+`</td>
                            <td> 
                                <button type="button" class="btn btn-danger" title="Click to Remove"> <span class="fa fa-times"></span> <b>Remove</b> </button>
                            </td>
                        </tr>
                    `;
                    $table_striped.append(outPut);
                });

               // console.log(outPut);
            });
        }

        // create record 
        function saveData(){

            //always check the URL
            url = "<?= site_url('index.php/AdminAssignatory/createAssig'); ?>";
            var frmData = $assigForm.serializeArray();

           // console.log(frmData);
            $.ajax({
                url:url,
                type:'POST',
                dataType:'json',
                data:frmData,
                success:function(response){
                    console.log(response);
                    if(response.data){
                        $table_striped.empty();
                        $assigForm[0].reset();
                        alert('Record Inserted');
                        getAssigDat();
                    }
                },
                error:function(reQuest, errType, errMsg){
                    alert('Error:' + errType + 'Message:' + errMsg);
                }
            });
        }

        // get Admin Data
         function getAdminDat(){
            url = "<?= base_url('index.php/AdminAssignatory/AdminDat'); ?>";
            $.get(url,function(response){
                
               response = $.parseJSON(response);
                //console.log(response.data[0].Pic);
                var picAdmin = "<?=base_url()?>/" + response.data[0].adminPic;
                $("#adminPic").attr('src',picAdmin);
                $("#adminName").text(response.data[0].UserName);

                console.log(response);
            });  
        }

        $(document).ready(function(){
            //calling function
            getAssigDat();
            getAdminDat();

            //active
            $("#hrefAssig").addClass('active');

            //delegation delete
            $table_striped.on('click', 'button.btn-danger', function(){
                var $prnt = $(this).closest('tr');
                var code = $prnt.find('td#code').text();
                url = "<?= site_url('index.php/AdminAssignatory/delAssig'); ?>/"+code;
                
                if (confirm("Are you sure to delete record?")) {
                    $.get(url, function(res){
                        res = $.parseJSON(res);
                        if(res.Status){
                            $table_striped.empty();
                            getAssigDat();
                        }
                    });

                    $prnt.fadeOut("slow");    
                }    
            });
        });
    </script>

</body>
</html>