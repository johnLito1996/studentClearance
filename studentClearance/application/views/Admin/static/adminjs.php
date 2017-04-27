<script>

        // adminData JS
        var url;
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
		};

        function getAdminDat(){
            url = "<?= base_url('index.php/AdminTeacher/AdminDat'); ?>";
            $.get(url,function(response){
                
               response = $.parseJSON(response);
                //console.log(response.data[0].Pic);
                var picAdmin = "<?=base_url()?>/" + response.data[0].adminPic;
                $("#adminPic").attr('src',picAdmin);
                $("#adminName").text(response.data[0].UserName);

                console.log(response);
            });

            
        }

		$(document).ready(function($) {
			app.init();
            getAdminDat();
		});
	</script>
