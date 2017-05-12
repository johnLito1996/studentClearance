<script>

        // adminData JS
        var url;

        function getAdminDat(){
            url = "<?= site_url('index.php/AdminTeacher/AdminDat'); ?>";
            $.get(url,function(response){
                
               response = $.parseJSON(response);
                //console.log(response.data[0].Pic);
                var picAdmin = "<?=base_url()?>/" + response.data[0].adminPic;
                $("#adminPic").attr('src',picAdmin);
                $("#adminName, #cUsername").text(response.data[0].UserName);
               // console.log(response);
            });  
        }

		$(document).ready(function($) {
            getAdminDat();
		});
	</script>
