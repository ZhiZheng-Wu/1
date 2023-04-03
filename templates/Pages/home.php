<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Property[]|\Cake\Collection\CollectionInterface $properties
 */

?>
<?php $this->disableAutoLayout() ?>

<!DOCTYPE html>
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
                                    <li><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
	            </header> <!-- end header -->

                <!--	BODY-->
                <section id="banner">
                    <!-- Slider -->
                    <div id="demo-1" data-zs-src='["img/photos/img1.jpg", "img/photos/img2.jpg", "img/photos/img3.jpg"]' data-zs-overlay="dots">
		                <div class="demo-inner-content">
			                <h1><span>Find the perfect landlord</span></h1><br/>
			                <p>Find the perfect property</p>
		                </div>
	                </div>
                    <!-- end slider -->
                    <section class="projects">
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
		            </section>

                    <section id="content">
	                    <div class="container">
                            <section class="services">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="aligncenter"><h2 class="aligncenter">Why use us to find your next home?</h2> We curate the very best properties for our prospective tenants. We also verify each landlord and tenant for your piece of mind.<br/></div>
                                        <br/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4 info-blocks">
                                        <i class="icon-info-blocks material-icons">track_changes</i>
                                        <div class="info-blocks-in">
                                            <h3>Verified Users</h3>
                                            <p>We verify our tenants and landlords to ensure your getting who they say they are.</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 info-blocks">
                                        <i class="icon-info-blocks material-icons">settings_input_svideo</i>
                                        <div class="info-blocks-in">
                                            <h3>Transparency</h3>
                                            <p>Our platform is transparent, all landlords and tenants have a rating which is indicative of itself.</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 info-blocks">
                                        <i class="icon-info-blocks material-icons">queue_music</i>
                                        <div class="info-blocks-in">
                                            <h3>Huge collection of properties</h3>
                                            <p>We have a massive collection of properties thanks to our extensive list of landlords and plenty of tenants looking for their next home.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4 info-blocks">
                                        <i class="icon-info-blocks material-icons">my_location</i>
                                        <div class="info-blocks-in">
                                            <h3>Easier application</h3>
                                            <p>We remove the middle man to create an easier, smoother, and quicker process with less hoops to jump through.</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 info-blocks">
                                        <i class="icon-info-blocks material-icons">shuffle</i>
                                        <div class="info-blocks-in">
                                            <h3>Tenant and Landlord History</h3>
                                            <p>Building on transparency, we log a detailed history of our landlords and tenants performance so you can make an informed decision</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 info-blocks">
                                        <i class="icon-info-blocks material-icons">tab_unselected</i>
                                        <div class="info-blocks-in">
                                            <h3>Effective Search</h3>
                                            <p>Search for properties, efficiently and effectively using our easy and advanced search modes</p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </section>

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
                                            <li><?= $this->Html->link('Benefits', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'benefits']); ?> </li>
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
                </section>
            </div>
            <a href="#" class="scrollup waves-effect waves-dark"><i class="fa fa-angle-up HillSide"></i></a>

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
</html>
