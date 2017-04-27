<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"> <b>Add Teacher</b> </h4>
			</div>
			<div class="modal-body">

				<form role="form" id="teachForm" method="POST">

				  <div class="form-group">
				  	 <div class="row">				  	 	
				  	 	 <div class="col-md-4 col-sm-4">
				  	 	 	<label> Teacher ID: </label>
				  	 	 	<input type="text" class="form-control cusInput" name="Teacher_ID" id="teachID" style="background-color: #DEC0F7; color:#500A0A;"readonly>
				  	 	 </div>
				  	 	 <div class="col-md-push-3 col-md-4 col-sm-4">
				  	 	 	<label for="teachStatus"> Status: </label>
				  	 	 	<select name="Status" class="form-control cusInput" id="teachStatus" readonly>
				  	 	 		<option value="Active"> Active </option>
				  	 	 		<!-- <option value="Active"> Non-Active </option> -->
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
							<input type="radio" class="flat-red" name="Gender" id="genderM" value="Male" checked> MALE &nbsp 
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

                  <input type="hidden" value="assets/template/img/custom/user.png" name="Teacher_Profile" id="teachProfile">
              </form>


			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
				<button class="btn btn-success" type="submit" onclick="saveData()">Save changes</button>
			</div>
		</div>
	</div>
</div>
<!-- modal -->