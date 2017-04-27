<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"> <b>Add Assignatory </b> </h4>
			</div>
			<div class="modal-body">

				<form role="form" id="assigForm" method="POST">

                  <div class="form-group">
                  	<div class="row">
                  		<div class="col-md-7 col-sm-5">
                  			<label> Assignatory Code: </label>
                      		<input type="text" class="form-control cusInput" name="Signatory_code" id="assigCode" placeholder="Code" maxlength="10">
                  		</div>
                  	</div>
                  </div>

                  <div class="form-group">
                  	<div class="row">
                  		<div class="col-md-7 col-sm-5">
                  			<label> Assignatory Description: </label>
                      		<input type="text" class="form-control cusInput" name="Signatory_description" id="assigDes" placeholder="Description" maxlength="50">
                  		</div>
                  	</div>
                  </div>

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