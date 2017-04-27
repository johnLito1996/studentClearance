// prototype
var app = {
	init:function(){
		//caching
		var $divG = $("div.form-group");
		$divG.on('focus', '#tMI', function(event) {
			$(this).val('');
		});
		$divG.on('blur', '#tMI', function(event) {
			$(this).val('-');
		});

		
	},
	saveData:function(method){
		$frm = $("#teachForm");
		var data = $frm.serializeArray();
		console.log(data);
		console.log(method);
	}

};

$(document).ready(function($) {
	app.init();
});

// function
function saveData(method){
	if (method == 'add') {
		app.saveData(method);
	}
	else{
		app.saveData(method);	
	}
	
}