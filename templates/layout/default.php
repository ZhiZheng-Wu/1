<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        The Perfect Landlord

    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <!--    selectsearch css-->


    <?= $this->Html->css(['backendlibrary/fontawesome/all.min.css', 'backendlibrary/sb-admin-2.css', 'custom.css']) ?>
    <?= $this->Html->script(['backendlibrary/jquery.js', 'backendlibrary/bootstrap.bundle.min.js', 'backendlibrary/sb-admin-2.js', 'backendlibrary/add.js']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!--    Jquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--    select search jQuery-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.selectSearch').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });
        });
    </script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>



</head>
<body>
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <?= $this->Html->link(
                    '<div class="sidebar-brand-icon rotate-n-15"><i class="icon-info-blocks material-icons">account_balance</i></div>
            <div class="sidebar-brand-text mx-3">The Perfect Landlord</div>'.

                '',['controller' => 'Pages', 'action' => 'display'], ['escape' => false, 'class'=>'sidebar-brand d-flex align-items-center justify-content-center'])
            ?>
        

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        
        <li class="nav-item"> 
            <?= $this->Html->link(
                    $this->Html->tag(
                        'i', 'dashboard',['class' => 'icon-info-blocks material-icons']).
                    $this->Html->tag('span', ' Homepage').

                '',['controller' => 'Pages', 'action' => 'display'], ['escape' => false, 'class'=>'nav-link'])
            ?>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Navigation
        </div>

        <!-- Nav Item  -->
        <li class="nav-item"> 
            <?= $this->Html->link(
                    $this->Html->tag(
                        'i', 'real_estate_agent', ['class' => 'icon-info-blocks material-icons']).
                    $this->Html->tag('span', ' Properties').

                '',['controller' => 'Properties', 'action' => 'index'], ['escape' => false, 'class'=>'nav-link'])
            ?>
        </li>
        

        <!-- Nav Item -->
        <li class="nav-item"> 
            <?= $this->Html->link(
                    $this->Html->tag(
                        'i', 'group', ['class' => 'icon-info-blocks material-icons']).
                    $this->Html->tag('span', ' Users').

                '',['controller' => 'Users', 'action' => 'index'], ['escape' => false, 'class'=>'nav-link'])
            ?>
        </li>
            
        <!-- Divider -->
        <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Profile
      </div>
      <?php
      $curr_id = $this->request->getAttribute('identity')->get('id');

      ?>


      <!-- Nav Item  -->

      <li class="nav-item">

        <?= $this->Html->link(
          $this->Html->tag(
            'i', 'person', ['class' => 'icon-info-blocks material-icons']).
          $this->Html->tag('span', ' Profile').

          '',['controller' => 'Users', 'action' => 'profile', $curr_id], ['escape' => false, 'class'=>'nav-link'])
        ?>
      </li>
      <!-- Divider -->




    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
<!--                <form-->
<!--                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">-->
<!--                    <div class="input-group">-->
<!--                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."-->
<!--                               aria-label="Search" aria-describedby="basic-addon2">-->
<!--                        <div class="input-group-append">-->
<!--                            <button class="btn btn-primary" type="button">-->
<!--                                <i class="icon-info-blocks material-icons">search</i>-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-info-blocks material-icons">person</i>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                          <?= $this->Html->link(
                            $this->Html->tag(
                              'i', 'person', ['class' => 'fas fa-sm fa-fw mr-2 text-gray-400 material-icons']).

                            ' Profile ',['controller' => 'Users', 'action' => 'profile', $curr_id], ['escape' => false, 'class'=>'dropdown-item'])
                          ?>

                          <div class="dropdown-divider"></div>
                          <?= $this->Html->link(
                            $this->Html->tag(
                              'i', 'logout', ['class' => 'fas  fa-sm fa-fw mr-2 text-gray-400 material-icons']).

                            ' Logout ',['controller' => 'Users', 'action' => 'logout', $curr_id], ['escape' => false, 'class'=>'dropdown-item'])
                          ?>

                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
               <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2020</span>
                </div>
            </div>
        </footer>
        End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

    <!--
    <footer>
        // $this->fetch('script')
    </footer>
-->
</body>
</html>
