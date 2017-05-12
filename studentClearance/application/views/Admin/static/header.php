   <header class="header">
        <a href="<?= site_url('index.php/AdminStudent'); ?>" class="logo">
            Student Clearance
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav" ng-controller="userCtr">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- <i class="fa fa-user"></i> -->
                    <img id="adminPic" width="25" height="25" class="img-rounded" alt="User Image" />
                    <span id="adminName"> LOGIN </span>

                    </a>
                    <ul class="dropdown-menu dropdown-custom dropdown-menu-right">

                        <li class="divider"></li>

                            <li id="hrefUtil">
                            <!-- utility.php -->
                                <a href="<?= site_url('index.php/AdminUtility') ?>">
                                <!--fa-cog fa-fw-->
                                <i class="fa fa-question pull-right"></i>
                                   <!--  <b>Profile</b> -->
                                    <b>Utility</b>
                                </a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="<?= site_url('index.php/Login/'); ?>"><i class="fa fa-ban fa-fw pull-right"></i> <b>Logout</b></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        </nav>
</header>