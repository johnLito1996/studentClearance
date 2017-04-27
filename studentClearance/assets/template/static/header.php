    <?php 
        if (empty($_SESSION['user_id'])) {
            
            $out = <<<EOD
            <i class="fa fa-user"></i>
            <span> Sign Up </span>

EOD;

        }
        /* 
        <span> Sign Up <i class="caret"></i></span> 
        <img src="img/custom/VERnt.png" width="25" height="25" class="img-rounded" alt="User Image" />'
        */
        else{
            // select image url here
            $out = <<<EOD
            <img src="img/custom/VERnt.png" width="25" height="25" class="img-rounded" alt="User Image" />
            <span> Name <i class="caret"></i></span>

            </a>
            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">

                <li class="divider"></li>

                    <li>
                        <a href="utility.php">
                        <!--fa-cog fa-fw-->
                        <i class="fa fa-question pull-right"></i>
                            <b>Utility</b>
                        </a>
                    </li>

                    <li class="divider"></li>

                    <li>
                        <a href="index2.php"><i class="fa fa-ban fa-fw pull-right"></i> <b>Logout</b></a>
                </li>
            </ul>
EOD;

        }
     ?>

    <header class="header">
        <a href="index.php" class="logo">
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
                        <?= $out; ?>

                        </li>
                
                    </ul>
                </div>
            </nav>
    </header>