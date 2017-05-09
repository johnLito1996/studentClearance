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
					<form role="form" id="secForm" method="POST">
					<fieldset>

					<legend> <b style="font-size: 15px;">Section Details</b> </legend>
					  <div class="form-group">
					  	 <div class="row">				  	 	
					  	 	 <div class="col-md-4 col-sm-4">
					  	 	 	<label style="display: inline;"> Section Name: </label>
					  	 	 	<input type="text" class="form-control cusInput upTxt" name="Section_code" id="secCode" placeholder="Section Name" maxlength="10">
					  	 	 </div>
					  	 </div>
					  </div>
					  <br>

	                  <div class="form-group">
	                  	<div class="row">
	                  		<div class="col-md-4 col-sm-4">
	                  			<label> Track: </label>
	                      		<select name="Track" id="secTrack" class="form-control cusInput">
	                      			<option value="Academic">Academic</option>
	                      			<option value="General">General</option>
	                      			<option value="Sports">Sports</option>
	                      			<option value="TVL">TVL</option>
	                      		</select>
	                  		</div>

	                  		<div class="col-md-4 col-sm-4">
	                  			<label> Strand: </label>
	                      		<input type="text" class="form-control cusInput" name="Strand" id="secStrand" placeholder="Strand/ Program">
	                  		</div>

	                  		<div class="col-md-4 col-sm-4">
	                  			<label> Room: </label>
	                      		<input type="text" class="form-control cusInput" name="Room_Number" id="secRoom" placeholder="Classroom">
	                  		</div>
	                  	</div>
	                  </div>
	                  <br>

	                  <div class="form-group">
	                  	<div class="row">
	                  		<div class="col-md-6 col-sm-6">
	                  			<label> Adviser: </label>
	                      		<select name="Adviser" id="secAdviser" class="form-control cusInput">
			              			
			              	  </select>
	                  		</div>

	                  		<div class="col-md-6 col-sm-6">
	                  			<label> Shift Sched: </label>
	                      		<select name="Shift_Sched" id="secShift" class="form-control cusInput">
	                      			<option value="FIRST">FIRST</option>
	                      			<option value="SECOND">SECOND</option>
	                      		</select>
	                  		</div>
	                  	</div>
	                  </div>
	                  <br>
					
					<div class="form-group">
	                  	<div class="row">
	                  		<div class="col-md-6 col-sm-6">
	                  			<label> Grade Level: </label>
	                      		<input type="text" class="form-control cusInput" name="Grade_level" id="secGLvl" placeholder="Section Level">
	                  		</div>

	                  		<div class="col-md-6 col-sm-6">
	                  			<label style="display: inline;"> High School Type: </label>
	                      		<select name="HS_Type" id="secHSType" class="form-control cusInput">
	                      			<option value="Junior High School"> Junior </option>
	                      			<option value="Senior High School"> Senior </option>
	                      		</select>
	                  		</div>
	                  	</div>
	                  </div>
	                </fieldset>

	                <input type="hidden" name="subjects[]">
              	</form>
				</div>
				<!--/.col1-->

				<div class="col-sm-6">
					<div class="row">

	                  <div class="form-group">
	                      
	                      <div class="row">
	                      	<div class="col-md-push-1 col-sm-4">
		                      <label>Subject List:</label>
		                      <select name="Subject_Code" id="Subject_Code" class="form-control cusInput">
			              	  </select>
		              	  	</div>

							<div class="col-md-push-1 col-sm-4" style="margin-top: 8px;"><br>
		              	  	<button class="btn btn-sm btn-primary" title="Add Subject" onclick="addSecSub()" type="button"><span class="fa fa-plus fa-md"></span> Add </button>
		              	  	</div>
		              	  </div>
	                  </div>
                        <!-- ./form-group -->

						<div class="scroll">
			              	<table class="table table-hover col-md-push-1" id="tblSecSub">
		                      <thead>
		                        <tr>
		                          <th> <b>Subject Code</b> </th>
		                          <th> <b>Teacher</b> </th>
		                          <th> <b>Action</b> </th>
		                      </tr>
			                  </thead>
			                  <tbody id="secSubTbody">

			                   <!--  <tr>
			                     <td> PROG </td>
			                     <td> Orogo, Cess </td>
			                     <td> 
			                       <button type="button" class="btn btn-danger customBtn"> <span class="fa fa-times"></span> Remove </button>
			                     </td>
			                   </tr> -->

		          			   </tbody>
		          			</table>
		          		</div>
		          		<!--./scroll-->
				   </div>
				   <!--./row-->
				</div>
				<!--./col-->
            </div>

			</div>
			<!-- ./modal-body -->
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
				<button class="btn btn-success" type="submit" onclick="saveData()" id="btnSecSave">Save changes</button>
			</div>
		</div>
	</div>
</div>
<!-- modal