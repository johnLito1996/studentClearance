<!-- Dynamic Modal -->
<div class="modal fade col-md-12" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 180%;margin-left: -37%;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"> <b id="modTitle"></b> </h4> 
			</div>
			<div class="modal-body">

			<div class="row">

				<div class="col-md-6 col-sm-6" style="border-right:thin solid #49495D;">
					<form role="form" id="studForm" method="POST">
					<fieldset>

					<legend> <b style="font-size: 15px;">Student Details</b> </legend>
					  <div class="form-group">
					  	 <div class="row">				  	 	
					  	 	 <div class="col-md-4 col-sm-4">
					  	 	 	<label style="display: inline;"> LRN Number: </label>
					  	 	 	<input type="text" class="form-control cusInput upTxt" name="LRN_Number" id="studLRN" maxlength="20">
					  	 	 </div>

							<div class="col-md-4 col-sm-4">
					  	 	 	<label style="display: inline;"> Password: </label>
  	 	 						<input type="text" name="Password" class="form-control cusInput upTxt" id="studPass" readonly>
					  	 	 </div>

							<!-- sa edit nalang etong select na dropbox -->
					  	 	 <div class="col-md-4 col-sm-4">
					  	 	 	<label style="display: inline;"> Status: </label>
					  	 	 	<select id="studStatus" name="Status" class="form-control cusInput">
					  	 	 		<option value="Enrolled"> Enrolled </option>
					  	 	 		<option value="Dropped"> Dropped </option>
					  	 	 	</select>
					  	 	 </div>
							

					  	 </div>
					  </div>
					  <br>

	                  <div class="form-group">
	                  	<div class="row">
	                  		<div class="col-md-4 col-sm-4">
	                  			<label> Last Name: </label>
	                      		<input type="text" class="form-control cusInput " name="Last_Name" id="studLName" placeholder="Last Name" maxlength="30">
	                  		</div>

	                  		<div class="col-md-4 col-sm-4">
	                  			<label> First Name: </label>
	                      		<input type="text" class="form-control cusInput" name="First_Name" id="studFName" placeholder=" First Name">
	                  		</div>

	                  		<div class="col-md-4 col-sm-4">
	                  			<label> M.I </label>
	                      		<input type="text" class="form-control cusInput" name="Initial" id="studMI" placeholder="M.I" maxlength="3" style="width: 41%;" value="-">
	                  		</div>
	                  	</div>
	                  </div>
	                  <br>

	                  <div class="form-group">
	                  	<div class="row">
	                  		<div class="col-md-6 col-sm-6">
	                  			<label> Gender: </label>
	                      		<input type="radio" value="Male" id="radMale" name="Gender" checked> Male &nbsp &nbsp
	                      		<input type="radio" value="Female" id="radFemale" name="Gender"> Female
	                  		</div>
	                  	</div>
	                  </div>
	                  <br>
					
					<div class="form-group">
	                  	<div class="row">
	                  		<div class="col-md-6 col-sm-6" id="conSelectSection">
	                  			<label style="display: inline;"> Section: </label>
	                      		<select name="Section_Code" id="studSecList" class="form-control cusInput">
	                      		</select>
	                  		</div>
	                  	</div>
	                  </div>
	                </fieldset>
              	</form>
				</div>
				<!--/.col1-->

				<div class="col-sm-6">
					<div class="row">
					<fieldset style="margin-left: 3%";>
					<legend> <b style="font-size: 15px;" id="secID"> Classmates List </b> <span class="pull-right" style="margin-right: 40px;">total student:<b id="totlClassMates">0</b></span> </legend>

					<ul class="list-group scroll" id="classmatesList">                       
					</ul>
					<!-- ./classmates -->

					</fieldset>
				   </div>
				   <!--./row-->
				</div>
				<!--./col-->
            </div>

			</div>
			<!-- ./modal-body -->
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
				<button class="btn btn-success" type="submit" onclick="saveData()" id="btnStudSave">Save New Student</button>
			</div>
		</div>
	</div>
</div>
<!-- modal