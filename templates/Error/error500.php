
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!DOCTYPE html>
<html>

<!-- css -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php
echo $this->Html->css(['publiclibrary/materialize.min.css']);
?>

<?php
echo $this->Html->css(['publiclibrary/bootstrap.min.css']);
?>

<?php
echo $this->Html->css(['fancybox/jquery.fancybox.css']);
?>

<?php
echo $this->Html->css(['publiclibrary/flexslider.css']);
?>

<?php
echo $this->Html->css(['publiclibrary/zoomslider.css']);
?>

<?php
echo $this->Html->css(['publiclibrary/style']);
?>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<!--BODY-->
<body>
<div id="wrapper" class="home-page">
    <!-- start header -->
    <header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?= $this->Html->link(
                        $this->Html->tag(
                            'i', 'account_balance',
                            ['class' => 'icon-info-blocks material-icons']).'The Perfect Landlord',
                        ['controller' => 'Pages', 'action' => 'display'], ['escape' => false, 'class'=>'navbar-brand'])
                    ?>
                </div>

                <!-- NAVIGATION BAR -->
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="HillSide"><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display']) ?></li>
                        <?php if ($this->request->getSession()->check('Auth.User')): ?>
                            <li><?= $this->Html->link(__('Properties for rent'), ['controller' => 'Properties', 'action' => 'membership']) ?></li>
                        <?php else: ?>
                            <li><?= $this->Html->link(__('Properties for rent'), ['controller' => 'Properties', 'action' => 'projects']) ?></li>
                        <?php endif; ?>
                        <li><?= $this->Html->link(__('About Us'), ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'about']); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </header> <!-- end header -->

<head>
    <title>Page not found</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            : 100px;
        }
        h1 {
            color: #333;
            font-size: 40px;
            text-align: center;
            margin-top: 100px;
        }
        p {
            color: #666;
            font-size: 20px;
            text-align: center;
            margin-top: 20px;
        }
        footer {
            margin-top:300px;
        }
    </style>
</head>
<body>
<h1>Error 500 - Page not found</h1>
<p>The page you requested could not be found.</p>
<?= $this->Html->link(__('Go Back'), 'javascript:history.back()', [
    'class' => 'button',
    'style' => 'background-color: white; color: black; text-decoration: none;margin-top: 50px;margin-bottom: 50px;'
]) ?>
</body>


    <!--                    FOOTER-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widgetheading">Our Contact</h5>
                        <address>
                            <strong>The Perfect Landlord</strong><br>
                            Wellington Rd, Clayton VIC 3800<br>
                        </address>
                        <p>
                            <i class="icon-phone"></i> Mobile: 0400 000 000<br>
                            <i class="icon-phone"></i> Fax: (03) 9905 4000<br>
                            <i class="icon-phone"></i> Email: perfectlandlord123@gmail.com<br>
                        </p>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widgetheading">MEMBERSHIP</h5>
                        <ul class="link-list">
                            <li><?= $this->Html->link('Benefits', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Privacy policy', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Sign Up', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Login', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                        </ul>
                    </div>
                </div>

                <!-- Company -->
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widgetheading">COMPANY</h5>
                        <ul class="link-list">
                            <li><?= $this->Html->link('About', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Media Center', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Help or Contact', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('FAQ', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                        </ul>
                    </div>
                </div>

                <!-- LEGAL -->
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widgetheading">LEGAL</h5>
                        <ul class="link-list">
                            <li><?= $this->Html->link('Privacy Policy', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Security', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Terms of use', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('EULA', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="copyright">
                            <p>
                                <span>&copy;2022 All rights reserved by The Perfect Landlord</span>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6">

                    </div>
                </div>
            </div>
        </div>
    </footer>
    </section>
</div>

<!-- javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/publiclibrary/jquery.js"></script>
<script src="js/publiclibrary/jquery.easing.1.3.js"></script>
<script src="js/publiclibrary/materialize.min.js"></script>
<script src="js/publiclibrary/bootstrap.min.js"></script>
<script src="js/publiclibrary/jquery.fancybox.pack.js"></script>
<script src="js/publiclibrary/jquery.fancybox-media.js"></script>
<script src="js/publiclibrary/jquery.flexslider.js"></script>
<script src="js/publiclibrary/animate.js"></script>
<!-- Vendor Scripts -->
<script src="js/publiclibrary/modernizr.custom.js"></script>
<script src="js/publiclibrary/jquery.zoomslider.min.js"></script>
<script src="js/publiclibrary/jquery.isotope.min.js"></script>
<script src="js/publiclibrary/jquery.magnific-popup.min.js"></script>
<script src="js/publiclibrary/animate.js"></script>
<script src="js/publiclibrary/custom.js"></script>
</body>
<a href="#" class="scrollup waves-effect waves-dark"><i class="fa fa-angle-up HillSide"></i></a>
</html>

