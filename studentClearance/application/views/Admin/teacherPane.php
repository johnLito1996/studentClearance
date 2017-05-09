<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Admin | Teacher </title>
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
             background-size: 100px;
/*             background-position: center;
         */
            background-position: top-left;        
        }

        .scroll{
            height: 450px; 
            overflow: auto;
        }

        .list-group-item:hover{
            background-color: #AED39E !important;
        }

        .hide{
            display:none;
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
                    
                    <span id="imgPath" class="hide"><?= $imgPath; ?></span>
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-md-push-2 col-lg-push-2">
                            <div class="panel">
                                <header class="panel-heading">
                                    <b>School Teachers</b>
                                </header>

                                <div class="panel-body">
                                <ul class="list-group teammates scroll">
                                    <!-- dynamic ul -->
                                </ul>
                                </div>

                                <div class="panel-footer bg-white">
                                    <!-- <span class="pull-right badge badge-info">32</span> -->
                                    <button class="btn btn-primary btn-addon btn-sm" data-toggle="modal" href="#myModal" data-backdrop="static" data-keyboard="false">
                                        <i class="fa fa-plus"></i>
                                        Add Teacher
                                    </button>

                                    <!-- modal -->
                                    <?php include('formModals/addTeach.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- row end -->
                </section>


            </div>
        </div><!-- ./wrapper -->

	<?php include_once('static/foot.php') ?>

    <!-- fetch the admin data -->
    <?php include_once('static/adminjs.php'); ?>
    <script type="text/javascript">

        // sidebar Active
        $("#hrefTeacher").addClass('active');

    //$.cache method
        var $teachForm = $("#teachForm");
        var $Teacher_ID = $("#teachID");
        var $Teacher_First_Name = $("#tFname");
        var $Teacher_MiddleInitial = $("#tMI");
        var $Teacher_Last_Name = $("#tLname");
        var $Gender = $("input[name='Gender']");
        var $Department = $("#teachDep");
        var $Status = $("#teachStatus");
        var $Teacher_Profile = $("#teachProfile");
        var $teachList = $("ul.teammates");
        var method = 'add';

        //ajax variables
        var url;
        var base = $("#imgPath").text();

        //current teachID
        function TeachlastId(){
            //event delegation nung add of button
            $.get("<?= site_url('index.php/AdminTeacher/newTeachId'); ?>", function(data, textStatus) {
                data = $.parseJSON(data);
                $("input#teachID").val(data.id);
            });
        }

        //list teacher
        function teachListView(){

            url = "<?= site_url('index.php/AdminTeacher/ajax_teach_list'); ?>";
            $.get(url, function(data){  
                //console.log(data);
                data = $.parseJSON(data);

                console.log(data.data);

                $.each(data.data, function(i, obj){
                    //console.log(i, 'data'+obj.Teacher_ID);
                    //$teachList.append('<li data-tID='+i+'></li>');

                    var output;
                    var fullName = obj.Teacher_First_Name +' '+obj.Teacher_MiddleInitial +' '+obj.Teacher_Last_Name;
                       
                        var usrImg = base + obj.Teacher_Profile;
                        var dataCol = "demo"+i;
                        output = "<ul id='active'>"+
                                        "<li class='list-group-item'>"+
                                            "<a disabled>"+
                                            "<img src="+usrImg+"  width='50' height='50' id='teachPic' alt='User'></a>"+
                                                "<button class='pull-right label label-warning inline m-t-15 statusBtn' id='teachDel' data-tNum='"+obj.Teacher_ID+"' title='Click to Deactivate'>Active</button>"+
                                                "<a href='#' data-toggle='collapse' data-target='#"+dataCol+"'>"+fullName+"</a>"+
                                                "<div id='"+dataCol+"' class='collapse'>"+
                                                "<br>"+
                                                "<p><label> ID : </label>"+obj.Teacher_ID+"</p>"+
                                                "<p><label> Gender : </label>"+obj.Gender+"</p>"+ 
                                                "<p><label> Department : </label>"+obj.Department+"</p>"+
                                                "</div>"+
                                            "</li>"+
                                        "</ul>";
                        $teachList.append(output);
                    
                });
                
            });
        }

        // saving teachData
        function saveData(){

            //default url is add
            var url = "<?= site_url('index.php/AdminTeacher/saveTeach') ?>/"+method;        
            var frmData = $("form#teachForm").serializeArray();

            $.ajax({
                url:url,
                type:'POST',
                dataType:'html',
                data:frmData,
                success:function(response){
                    //console.log(response);
                    $teachForm[0].reset();
                    TeachlastId();
                    alert('Data has successfully added!');
                    $teachList.empty();
                    teachListView();
                },
                error:function(reQuest, errType, errMsg){
                    alert('Error:' + errType + 'Message:' + errMsg);
                }
            })
        }

        //document ready
        $(document).ready(function(){

           // alert(window.location.origin);
            TeachlastId();
            teachListView();
            //for Deactivation Teacher
            $("ul.teammates").on('click', 'button#teachDel', function(event) {
                event.preventDefault();

                var id = $(this).data('tnum');
                var url = "<?= site_url('index.php/AdminTeacher/delTeachList'); ?>/"+id;
                //var $ulCurrent = $(this).closest('ul#tActive');
                // if nag true  e lolocate ko si closest na ul niya then fadeOut(1000)
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'JSON'
                })
                .done(function(response) {

                    if (response.status) {
                        $teachList.empty();
                        teachListView();
                    }
                })
                .fail(function(response) {
                    console.log("error in ajaxDelete");
                });
                
            });

        });
    </script>

</body>
</html>