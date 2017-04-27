<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="display: none;">
            <div class="col-sm-6 col-sm-push-3">
                <img id="adminPic" class="img-circle" width="70" alt="User Image" />
            </div>
            
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li id="hrefStudent">
                <a href="<?= site_url('index.php/AdminStudent'); ?>">
                    <i class="fa fa-graduation-cap"></i> <span>Student</span>
                </a>
            </li>
            <li id="hrefTeacher">
                <a href="<?= site_url('index.php/AdminTeacher'); ?>">
                    <i class="fa fa-group"></i> <span>Teacher</span>
                </a>
            </li>

            <li id="hrefSection">
                <a href="<?= site_url('index.php/AdminSection'); ?>">
                    <i class="fa fa-list-ol"></i> <span>Section</span>
                </a>
            </li>

            <li id="hrefAssig">
                <a href="<?= site_url('index.php/AdminAssignatory'); ?>">
                    <i class="fa fa-weixin"></i> <span>Assignatory</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->

    <ul id="secList" class="chk" style="margin:15px; background-color: #F2E5E5;">
        <li>WAit in the Section panel <br> and make this work :)</li>
    </ul>
</aside>