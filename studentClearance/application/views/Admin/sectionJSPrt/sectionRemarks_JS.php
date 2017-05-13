<script type="text/javascript">
	
	//cache
	var $stuRemarks = $("tbody#studListRemarks");
  
  //global
   var $secCode;
   var searchMethod;

// change the div#divRmkStudents
    function secClearance(secCode) {

        $("#btnSecStuds").attr('disabled', 'true');

    	searchMethod = 'student';
    	$("#btnSecStuds, #btnSecSubs").removeAttr('disabled');

    	$secCode = secCode;
		$("b#secName").text(secCode);

    }

// function remarks[using]Subjects
    function remarksRadio(status, i) {

    	switch(status) {
		    case "INC":
		        return `
		        <td data-status="`+status+`">
				<div class="col-sm-4"><input type="radio" name="Status`+i+`" id="statOK" value="OK"> OK </div>
                <div class="col-sm-4"><input type="radio" name="Status`+i+`" id="statINC" checked value="INC"> INC </div>
                <div class="col-sm-4"><input type="radio" name="Status`+i+`" id="statDrp" value="DRP"> DROP </div>
		 		</td>
		 	`;
		        break;

		    case "OK":
		        return `
		        <td data-status="`+status+`">
				<div class="col-sm-4"><input type="radio" name="Status`+i+`" id="statOK" checked value="OK"> OK </div>
                <div class="col-sm-4"><input type="radio" name="Status`+i+`" id="statINC" value="INC"> INC </div>
                <div class="col-sm-4"><input type="radio" name="Status`+i+`" id="statDrp" value="DRP"> DROP </div>
		 		</td>
		 	`;
		        break;

	        case "DRP":
	        	return `
	        	<td data-status="`+status+`">
				<div class="col-sm-4"><input type="radio" name="Status`+i+`" id="statOK" value="OK"> OK </div>
                <div class="col-sm-4"><input type="radio" name="Status`+i+`" id="statINC" value="INC"> INC </div>
                <div class="col-sm-4"><input type="radio" name="Status`+i+`" id="statDrp" checked value="DRP"> DROP </div>
		 		</td>
		 	`;
	        break;

		    default:
		        return `
		        <td data-status="`+status+`">
				<div class="col-sm-4"><input type="radio" name="Status`+i+`" id="statOK" value="OK"> OK </div>
                <div class="col-sm-4"><input type="radio" name="Status`+i+`" id="statINC" value="INC"> INC </div>
                <div class="col-sm-4"><input type="radio" name="Status`+i+`" id="statDrp" value="DRP"> DROP </div>
		 		</td>
		 	`;
		}
    }

    // searching via subjects 
    function getsecSub() {

    	searchMethod = 'subject';
    	$("#btnSecStuds").removeAttr('disabled');
    	$("select#secSubs").empty();
    	$("#btnSecSubs").attr('disabled', 'true');
    	$("#lblSearch").text('Subject Name:');
    	url = "<?= site_url('index.php/clearance/getsubsec') ?>/"+$secCode;
		$.get(url, function(data){
			//console.log(data);

			data = $.parseJSON(data);

/*			console.log(data);
*/			
			$("select#secStuds").empty();

			$("select#secStuds").attr({
				'name':'sectionSubjects',
				'id':'secSubs'
			});

			var outSelect = "<option selected disabled> -Choose Subjects- </option>";
			$.each(data.data, function(i, obj){
				outSelect += "<option value="+obj.Subject_Code+">"+obj.Subject_Description+"</option>";
			});
			$("select#secSubs").append(outSelect);
		});

		// changing the table header
		$("#titleChange").text('Student Name');
		// fetching the new tbody with proper statusis
    }

    //section student Btn
    function secStud() {
    	
        var crntSecCode = $("b#secName").text();
    	searchMethod = 'student';
    	//alert(searchMethod);
       
        $("#btnSecStuds").attr('disabled', 'true');
    	$("#btnSecSubs").removeAttr('disabled');
    	$("#lblSearch").text('Student Name:');
    	$("select#secSubs").attr({
				'name':'sectionStudents',
				'id':'secStuds'
		});
		$("#titleChange").text('Remarks List');
    	
        //alert(crntSecCode);
        //return;
        //secClearance(crntSecCode);
        var url = "<?= site_url('index.php/clearance/getstudentlist') ?>/"+crntSecCode;
      
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
            })
            .done(function(data) {
                //console.log(data);
                $("select#secStuds").replaceWith(data);

            })
            .fail(function() {
                console.log("error");
            });
        
    }

    function editStudRemarks() {

    	//alert(searchMethod);

    	// current status length
    	var statusLength = ($('input[type="radio"]').length / 3)
    	var currentRemarks = $("form#frmStudRemarks").serializeArray();

    	//console.log("that the data in the form now");

    	//alert(statusLength);

    	var statusChecked = $('input[type="radio"]:checked').length;
    	//console.log("total radio checked: "+statusChecked);
    	//return;
    	//currentRemarks.splice(0,1);
    	currentRemarks.shift();
//
    	console.log(typeof(currentRemarks)); // so mga radio nading na checked
    	console.log(currentRemarks); // so mga radio nading na checked
    	//return;


    	var $TR = $("#studListRemarks").find('tr');
    	
    	var keys = [];
    	var values = [];
    	var fJson = {};
    	$TR.each(function(i, obj){
    		var data = $(this).data('signatory');
    		keys.push(data);
    	})
    	//console.log(JSON.stringify(keys));

		// get all the radio status the new
		for (var i = 0; i < currentRemarks.length; i++) {
			values.push(currentRemarks[i].value);
		}

		//setting the obj key:value pair
    	for (var i = 0; i<values.length; i++) {
    		//fJson.push(keys[i]+":"+values[i]);
    		fJson[keys[i]] = values[i];
    	}

    	fJson = JSON.stringify(fJson);

    	// javascript POST ARRAY :)
    	//console.log(fJson);
    	if (searchMethod == "student") {

    		fJsonOut = {
    		'data':fJson,
    		'RemarksCode':keys,
    		'LRN_Number':$("select#secStuds").val(),
    		'Section_Code':$("b#secName").text(),
    		}

    	}
    	else{
			//To be continue ka bukas back to home nako haha
    		fJsonOut = {
    		'data':fJson,
    		'StudLRN':keys,
    		'Subject_Signatory_Code':$("select#secSubs").val(),
    		'Section_Code':$("b#secName").text(),
    		}
    	}
    	
    	//console.log(fJsonOut);

    	url = "<?= site_url('index.php/clearance/getjstatusremarks') ?>/"+searchMethod;
    	$.ajax({
    		url: url,
    		type: 'POST',
    		dataType: 'html',
    		data: fJsonOut,
    	})
    	.done(function(data) {
    		console.log("success");
    		//console.log(data);
            alert('Remarks Updated');
    	})
    	.fail(function() {
    		console.log("error");
    	});
    	

    }
    // decoding utf8_encode dat
    function decode_utf8(s) {
	  return decodeURIComponent(escape(s));
	}

	// encode utf8_char
	function encode_utf8(s) {
	  return unescape(encodeURIComponent(s));
	}

    $(document).ready(function() {
    	
    	//delegation remarks students section
	    	$("div#selectStudentDrop").on('change', 'select#secStuds', function(evt){

    		evt.preventDefault();
    		var secName = $("b#secName").text();
    		var secLrn = $("select#secStuds").val();
    		var url = "<?= site_url('index.php/clearance/getstudremarks')?>/"+secName+"/"+secLrn;
	    	var respTable;

	    		$stuRemarks.empty();
	    		$.get(url,function(data){
	    			//console.log(data);
	    			data = $.parseJSON(data);
	    			//console.log(data);

	    			$.each(data.data, function(i, obj){
	    				var Subject_Signatory_Code = obj.Subject_Signatory_Code;
	    				var Category = obj.Category;
	    				var LRN_Number = obj.LRN_Number;
	    				var Status = obj.Status;

	    				//console.log(Status);
	    				var tdRemarks = remarksRadio(Status, i);
	    				
	    				//console.log(tdRemarks);
	    				var Append = '<tr data-signatory='+Subject_Signatory_Code+'><td>'+Subject_Signatory_Code+'</td><td>'+Category+'</td>'+tdRemarks+'</tr>';

	    				$("tbody#studListRemarks").append(Append);

	    				//console.log(Append);
	    			});
	    		});

			});

			// this is the chage of section subject select stuRemarks
			$("div#selectStudentDrop").on('change', 'select#secSubs', function(evt){
				evt.preventDefault();

				var ctr;
				var subject = $("select#secSubs").val();
				url = "<?= site_url('index.php/clearance/getsubremarks')?>/"+$secCode+"/"+subject;
				
				var Lrn; 
				var lngth;
				$.get(url, function(data){
					data = $.parseJSON(data);

					//console.log(data);
					$("tbody#studListRemarks").empty();
					$.each(data.response, function(i, obj){
						var studName = decode_utf8(obj.Last_Name+", "+ obj.First_Name);
	    				var Category = obj.Category;
	    				//var LRN_Number = obj.LRN_Number;
	    				var Status = obj.Status;

	    				//console.log(Status);
	    				var tdRemarks = remarksRadio(Status, i);
	    				
	    				//console.log(tdRemarks);
	    				var Append = '<tr data-signatory='+obj.LRN_Number+'><td>'+studName+'</td><td>'+Category+'</td>'+tdRemarks+'</tr>';

	    				$("tbody#studListRemarks").append(Append);
					});
					 
				})

			});
			
	    });
</script>