<?php
/* Based on 2022S1 implementation */

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();
?>

<!DOCTYPE html>
    <html>
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

            <?= $this->Html->charset() ?>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>
                The Perfect Landlord
            </title>

            <?= $this->Html->meta('icon') ?>
            <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

            <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'home', 'login']) ?>

            <?= $this->fetch('meta') ?>
            <?= $this->fetch('css') ?>
            <?= $this->fetch('script') ?>

            <style>
                footer{
                    padding-top: 10px;
                    display: block;
                }

                body {
                }

                * {
                    -webkit-font-smoothing: antialiased;
                    -moz-osx-font-smoothing: grayscale;
                }
                #anchorOurTeam{
                    display: block;
                    height:100px;
                    margin-top: -45px; /*same height as header*/
                    visibility: hidden;
                }
                article,
                aside,
                header,
                nav,
                section {
                    display: block;
                }
                div.form {
                    background-color: white;
                    width: 50%;
                    padding-top: 5em;
                    padding-bottom: 2em;
                    margin: auto;
                }
                input {
                    width: 75%;
                }
                legend {
                    text-align: center;
                }
                body {
                    background: -webkit-linear-gradient(left, #e91e63, black, #e91e63);
                }
                div.formbody {
                    text-align:center;
                    margin: auto;
                    width: 50%;
                    background-color: #e91e63 ;
                }
                legend {
                    color: #fcfbfb;
                }
                fieldset {
                    text-align:left;
                    margin: auto;
                    width: 75%;
                }
                div.navbar{
                    width: 100%;
                    position: fixed;
                    padding-top: 0px;
                    margin-top: 0px;
                    top: 0px;
                    z-index: 9999;
                }

                footer{
                    margin-bottom: 0px;
                    padding-bottom:0px ;
                    bottom: -100px;
                    z-index: 9999;
                    width: 100%;
                    position: relative;
                }


                div.pleaseloginbelow{
                    padding: 60px;
                    text-align: center;
                    background: #f8f8f8;
                    color: #e91e63;
                    font-size: 30px;
                }
                a{
                    text-decoration: none;
                }
                a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>

    <!-- START HEADER -->
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
                        <li><?= $this->Html->link(__('Properties for rent'), ['controller' => 'Properties', 'action' => 'projects']) ?></li>
                        <li><?= $this->Html->link(__('About Us'), ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'about']); ?></li>
                        <li><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- HEADING LOGIN -->
        <section id="inner-headline" style="background-color: #e91e63; border-radius: initial">
            <div class="container">
                <div class="row" >
                    <div class="col-lg-12">
                        <h2 class="pageTitle" style="color: white">LOGIN BELOW</h2>
                    </div>
                </div>
            </div>
        </section>
    </header>

    <!--Please enter your email below -->
    <main class="main">
        <!-- Start of things from AUTH codebook tutorial: https://book.cakephp.org/4/en/tutorials-and-examples/cms/authentication.html -->
        <div class="form formbody">
            <?= $this->Flash->render() ?>
            <?= $this->Form->create() ?>

            <fieldset>
                <legend class="formbody" style="background-color: white; color: black"><?= __('ENTER YOUR EMAIL AND PASSWORD') ?></legend>
                <?= $this->Form->control('email', ['required' => true, 'class' => 'formbody']) ?>
                <?= $this->Form->control('password', ['required' => true, 'class' => 'formbody']) ?>
            </fieldset>
            <br/>
            <?= $this->Form->submit(__('Login')); ?>
            <?= $this->Form->end() ?>
            <?= $this->Html->link(
                '<span class="text">Forgot Password</span>',
                ['controller'=>'Users','action' => 'forgotpassword'],
                ['escape' => false])
            ?>
        </div>
    </main>
        <!-- End of things from AUTH codebook tutorial: https://book.cakephp.org/4/en/tutorials-and-examples/cms/authentication.html -->
</body>


    <br><br><br><br>
    <!-- FOOTER -->
    <div class="separator"></div>
    <footer style="border-radius: initial">
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

                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widgetheading">COMPANY</h5>
                        <ul class="link-list">

                            <li><?= $this->Html->link('About', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Media Center', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('Help or contact', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                            <li><?= $this->Html->link('FAQ', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'progress']); ?> </li>
                        </ul>
                    </div>
                </div>

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
</html>
