<!DOCTYPE html>
<html lang="en">

<?php $this->disableAutoLayout() ?>
<head>
    <meta charset="utf-8">
    <title>The Perfect Landlord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="http://webthemez.com" />
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

    <style>
        #anchorOurTeam{
            display: block;
            height:100px;
            margin-top: -45px; /*same height as header*/
            visibility: hidden;
        }
    </style>
</head>

<body>
<div id="wrapper">
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
                        <li><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?></li>
                    </ul>
                </div>
            </div>
        </div>
	</header>

    <!-- ABOUT US HEADER -->
	<section id="inner-headline" style="background-color: #e91e63">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="pageTitle" style="color: white;">About Us</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
	<section id="content">
        <section class="section-padding">
            <div class="container">
                <div class="row showcase-section">
                    <div class="col-md-6">
                        <?= $this->Html->image('dev1.png', ['alt'=>'showcase image']) ?>
                    </div>
				    <div class="col-md-6">
                        <div class="about-text">
						    <h3>Our <span class="color">Company</span></h3>
                            <p>We started The Perfect Landlord because we wanted to improve the rental application process after many years of experience in the industry. We knew that there were plenty of ways for renters and landlords to enter into their relationship, but there was no way for them to make sure that they were doing it right.</p>
                            <p>Through cutting-edge technology and years of experience, we've developed a platform that allows you to manage your rental property from anywhere in the world—all without having to leave your computer or phone. We've also created an intuitive interface that makes it easy for renters and landlords alike to request information about their rental properties, communicate with each other, and manage aspects of their relationships.</p>
                            <p>We're here because we believe in making things easier for everyone involved in property management—whether it's renters or landlords—and we want our services to be available wherever you are.</p>
					    </div>
				    </div>
                </div>
		    </div>
	    </section>

	    <div class="container">
            <div class="about">
                <div class="row">

                </div>
                <div class="block-heading-six">
                    <span class="anchorOurTeam" id="anchorOurTeam"></span>
                    <h3><b>Our</b> <span class="color"><b>Team</b></span></h3>
                </div>
                <br>
                <?php echo "\n" ?>

                <!-- Our team section -->
                <div class="team-six" >
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <!-- Team Member -->
                            <div class="team-member">
                                <!-- Image -->
                                <?php echo $this->Html->image('team1.jpg', ['alt'=>'showcase image','class'=>'img-responsive']) ?>
                                <!-- Name -->
                                <h4> Jane Doe</h4>
                                <span class="deg">CEO</span>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <!-- Team Member -->
                            <div class="team-member">
                                <!-- Image -->
                                <?php echo $this->Html->image('team2.jpg', ['alt'=>'showcase image','class'=>'img-responsive']) ?>
                                <!-- Name -->
                                <h4>Jason Myers</h4>
                                <span class="deg">CFO</span>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <!-- Team Member -->
                            <div class="team-member">
                                <!-- Image -->
                                <?php echo $this->Html->image('team3.jpg', ['alt'=>'showcase image','class'=>'img-responsive']) ?>
                                <!-- Name -->
                                <h4>Christean Eriksson</h4>
                                <span class="deg">CTO</span>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <!-- Team Member -->
                            <div class="team-member">
                                <!-- Image -->
                                <?php echo $this->Html->image('team4.jpg', ['alt'=>'showcase image','class'=>'img-responsive']) ?>
                                <!-- Name -->
                                <h4>Kerinele Rase</h4>
                                <span class="deg">Client Success Specialist</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Our team ends -->
            </div>
        </div>
	</section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="widget">
                        <!-- OUR CONTACT -->
                        <h5 class="widgetheading">OUR CONTACT</h5>
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
                <!--MEMBERSHIP -->
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widgetheading">MEMBERSHIP</h5>
                        <ul class="link-list">
                            <li><?= $this->Html->link('Benefits', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'benefits']); ?> </li>
                            <li><?= $this->Html->link('Privacy policy', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Sign up', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
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

        <!-- FOOTER (RIGHTS) -->
        <div id="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="copyright">
                            <p>
                                <span>&copy;2023 All rights reserved by The Perfect Landlord</span>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6">

                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<a href="#" class="scrollup waves-effect waves-dark"><i class="fa fa-angle-up HillSide"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.easing.1.3.js');
echo $this->Html->script('materialize/js/materialize.min.js');
echo $this->Html->script('bootstrap.min.js');
echo $this->Html->script('jquery.fancybox.pack.js');
echo $this->Html->script('jquery.fancybox-media.js');
echo $this->Html->script('jquery.flexslider.js');
echo $this->Html->script('animate.js');

//<!-- Vendor Scripts -->

echo $this->Html->script('modernizr.custom.js');
echo $this->Html->script('jquery.isotope.min.js');
echo $this->Html->script('jquery.magnific-popup.min.js');
echo $this->Html->script('animate.js');
echo $this->Html->script('custom.js');
echo $this->Html->script('');



?>

</body>
</html>
