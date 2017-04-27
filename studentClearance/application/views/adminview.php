<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Teacher</title>
	
</head>
<body>
	<form role="form" id="teachForm" method="POST">

				  <div class="form-group">
				  	 <div class="row">				  	 	
				  	 	 <div class="col-md-4 col-sm-4">
				  	 	 	<label> Teacher ID: </label>
				  	 	 	<input type="text" class="form-control cusInput" name="Teacher_ID" id="teachID" style="background-color: #DEC0F7; color:#500A0A;" readonly>
				  	 	 </div>
				  	 	 <div class="col-md-push-3 col-md-4 col-sm-4">
				  	 	 	<label for="teachStatus"> Status: </label>
				  	 	 	<select name="Status" class="form-control cusInput" id="teachStatus">
				  	 	 		<option value="Active"> Active </option>
				  	 	 		<option value="Active"> Non-Active </option>
				  	 	 	</select>
				  	 	 </div>
				  	 </div>
				  </div>

                  <div class="form-group">
                  	<div class="row">
                  		<div class="col-md-7 col-sm-7">
                  			<label for="tLname"> Last Name: </label>
                      		<input type="text" class="form-control cusInput" name="Teacher_Last_Name" id="tLname" placeholder="Last Name">
                  		</div>
                  	</div>
                  </div>

                  <div class="form-group">
                  	<div class="row">
                  		<div class="col-md-7 col-sm-7">
                  			<label for="tFname"> First Name: </label>
                      		<input type="text" class="form-control cusInput" name="Teacher_First_Name" id="tFname" placeholder="First Name">
                  		</div>
                  	</div>
                  </div>

                  <div class="form-group">
         	 		<label for="tMI"> M.I </label>
                  	<input type="text" class="form-control cusInput" style="width: 15%; text-transform: uppercase;" name="Teacher_MiddleInitial" id="tMI" value="-" maxlength="2">
                  </div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<label for=""> Gender:</label>
							<input type="radio" class="flat-red" name="Gender" id="genderM" value="Male"> MALE &nbsp 
							<input type="radio" class="flat-red" name="Gender" id="genderFM" value="Female"> FEMALE
						</div>
					</div>
				</div>

                  <div class="form-group">
                  	<div class="row">
                  		<div class="col-md-3 col-sm-3">
                  			<label for="teachDep"> Department:</label>
                  			<input type="text" name="Department" id="teachDep" class="form-control cusInput">
                  		</div>
                  	</div>
                  </div>

                  <input type="text" value="<?= base_url('assets/template/img/custom/user.png'); ?>" name="Teacher_Profile" id="teachProfile">
              </form>
		<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
		<button class="btn btn-success" type="submit" onclick="saveData()">Save changes</button>


		<ul class="list-group teammates" style="width: 300px; height: 200px; overflow: auto">
		</ul>

	<!-- jQuery -->
	<script src="<?= base_url('assets/jquery/jquery-2.1.4.min.js'); ?>"></script>
	<script>
		//form fields
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

		function TeachlastId(){
			//event delegation nung add of button
			$.get("<?= site_url('index.php/AdminTeacher/newTeachId'); ?>", function(data, textStatus) {
				data = $.parseJSON(data);
				$("input#teachID").val(data.id);
			});
		}

		function teachListView(){

			$.get("<?= site_url('index.php/AdminTeacher/ajax_teach_list') ?>", function(data){	
				//console.log(data);
				data = $.parseJSON(data);

				//console.log(data.data);
				$.each(data.data, function(i, obj){
					//console.log(i, 'data'+obj.Teacher_ID);
					//$teachList.append('<li data-tID='+i+'></li>');

					var output;
					var fullName = obj.Teacher_First_Name +' '+obj.Teacher_MiddleInitial +' '+obj.Teacher_Last_Name;
					if(typeof(obj.Status) == 'string' && obj.Status == 'Active'){
						//active

						output = "<ul id='tActive'><li>"+fullName+
						"<li> <b>ID:</b>"+obj.Teacher_ID+"</li>"+
						"<li> <b>Gender:</b>"+obj.Gender+"</li>"+
						"<li> <b>Department:</b>"+obj.Department+"</li>"+
						"<li> <b>Status:</b>"+obj.Status+"</li>"+
						"<li> <button data-tNum='"+obj.Teacher_ID+"' id='teachDel'> Delete </button>"+
						"</li></ul>";

						$teachList.append(output);
					}
					
				});
				
			});
		}

		$(document).ready(function($) {

			TeachlastId();
			teachListView();
			//edit teacher
			$("ul.teammates").on('click', 'button#teachEdit', function(event) {
				event.preventDefault();
				var id = $(this).data('tnum');
				var url = "<?= site_url('index.php/AdminTeacher/getTeachDat'); ?>/"+id;
				//var fields = $("form#teachForm").serializeArray();
				$.get(url, function(json, textStatus) {
					
					json = $.parseJSON(json);
					$.each(json.data,function(i, obj) {
						//console.log(i, obj.Teacher_Last_Name);
						$Teacher_ID.val(obj.Teacher_ID);
						$Teacher_First_Name.val(obj.Teacher_First_Name);
						$Teacher_MiddleInitial.val(obj.Teacher_MiddleInitial);
						$Teacher_Last_Name.val(obj.Teacher_Last_Name);

						//radioButton
						if(obj.Gender == 'Male'){
							$("#genderM").prop('checked', true);
						}
						else{
							$("#genderFM").prop('checked', true);
						}

						$Department.val(obj.Department);
						
						if(obj.Status == 'Active'){
							$Status.html("<option value='Active'>Active</option><option value='Non-Active'>Non-Active</option>");
						}
						else{
							$Status.html("<option value='Non-Active'>Non-Active</option><option value='Active'>Active</option>")
						}
					});
				});
			});


			//for delete teacher
			$("ul.teammates").on('click', 'button#teachDel', function(event) {
				event.preventDefault();

				var id = $(this).data('tnum');
				var url = "<?= site_url('index.php/AdminTeacher/delTeachList'); ?>/"+id;
				var $ul = $(this).closest('ul#tActive');
				// if nag true  e lolocate ko si closest na ul niya then fadeOut(1000)
				$.ajax({
					url: url,
					type: 'GET',
					dataType: 'JSON'
				})
				.done(function(response) {

					if (response.status) {
						$ul.fadeOut(1000);
					}
				})
				.fail(function(response) {
					console.log("error in ajaxDelete");
				});
				
			});
		});

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
	</script>
</body>
</html>