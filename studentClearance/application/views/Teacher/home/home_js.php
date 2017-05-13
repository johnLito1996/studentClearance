<script>
//cacheDOM 
    var $teachPic = $("#teacherPic");
    var $teachName = $("#teacherName");

//ajax VAR
    var url; 
    var data;

//constant DVAR
    var crntTeachID = $("#teachID").text();
        function getTeacherDat(){
            url = "<?= site_url('index.php/teacher/crntloginteachdAt') ?>/"+crntTeachID;
            $.get(url, function(tDat){
                tDat = $.parseJSON(tDat);

                var dataOutTeach = tDat.teacherDAt[0];
                var fullName = dataOutTeach.Teacher_Last_Name + ", " + dataOutTeach.Teacher_First_Name;
                $teachName.text(fullName);
                var picTure = "<?= base_url() ?>"+dataOutTeach.Teacher_Profile;
                $teachPic.attr('src', picTure);
            });
        }

        var table;
        $(document).ready(function(){
            getTeacherDat();

            table = $("table#tblTeachSection").DataTable({
                  "bFilter":false,
                  "ajax":{
                      "url":"<?= site_url('index.php/teacher/ajax_sec_list_byteach'); ?>/"+crntTeachID,
                      "type":"POST"
                  },//ajax propeties with object JSON data
                  "columns":[
                      {"data":"Section_code"},
                      {"data":"Track"},
                      {"data":"Strand"},
                      {"data":"Room_Number"},
                      {"data":"Grade_level"},
                      {"data":"Shift_Sched"},
                      {"data":"Action"}
                  ]

              });
        });
    </script>
