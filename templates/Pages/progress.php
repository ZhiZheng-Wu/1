<!DOCTYPE html>
<?php $this->disableAutoLayout() ?>
<html lang="en">
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

</head>
<body>
<div id="wrapper">
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
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="HillSide"><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display']) ?></li>

                    <li><?= $this->Html->link(__('About Us'), ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'about']); ?></li>

                        <li><?= $this->Html->link(__('Properties for rent'), ['controller' => 'Properties', 'action' => 'projects']) ?></li>
                        <!-- <li class="HillSide"><a href="portfolio.html" class="waves-effect waves-dark" >Gallery</a></li> -->
                         <li><?= $this->Html->link(__('Admin'), ['controller' => 'Users', 'action' => 'index']) ?></li>
                    </ul>
                </div>
            </div>
        </div>
	</header><!-- end header -->
	<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Work In Progress</h2>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
	<section class="section-padding">
		<div class="container">
						<h3>Not Available Right Now <span class="color"></span></h3>
						<div class="about-text">
                            <p>Unfortunately, this page is under development right now. Please check back at a later date. </p>
                            <p> Until then, take a look at some of our listed properties below! Happy browsing. </p>
                        </div>
				</div>
			</div>
		</div>
	</section>
    <br>
    <br>
    <br>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="aligncenter"><h2 class="aligncenter">Recommended Properties</h2> Take a look at some of our recommended rental properties below and find your next home</div>
            <br/>
        </div>
    </div>

        <div class ="aligncenter">
            <?= $this->Html->link(__('Properties for rent'), ['controller' => 'Properties', 'action' => 'projects'], ['class'=>'btn btn-details2']) ?>
        </div>
    </div>

<section id="content">
    <div class="container">


    </div>
	</section>
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


                            <!--                    <i class="icon-envelope-alt"></i> contact@tplat.com-->
                        </p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widgetheading">Quick Links</h5>
                        <ul class="link-list">

                            <li><?= $this->Html->link('Terms and conditions', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Privacy policy', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Career', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Contant Us', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widgetheading">Community</h5>
                        <ul class="link-list">

                            <li><?= $this->Html->link('Features', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Advertising', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Partners', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('FAQ', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>


                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widgetheading">Legal</h5>
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
