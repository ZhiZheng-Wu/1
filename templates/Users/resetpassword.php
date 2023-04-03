
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

<style>
    input {width: 75%;}
    legend {text-align: center;}
    fieldset {width: 75%;}
    body { background:-webkit-linear-gradient(left, #1b1b1b,#e91e63,#1b1b1b); }
    /* Testing CSS */
    /* {outline: 1px dashed red;} */

</style>
<head>
    <div class="head">
        <center>
            <h1>The Perfect Landlord</h1>
            <h2>Please enter your new password</h2>
        </center>
    </div>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reset - The perfect Landlord</title>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['styles']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body class="bg-primary" style="height:100vh; margin-top:-10vw">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Password Recovery</h3></div>
                            <div class="card-body">
                                <div class="small mb-3 text-muted" >Please enter a new password for your account.</div>


                                <div class="form-floating mb-3">

                                    <?php echo $this->Flash->render() ?>
                                    <?= $this->Form->create() ?>
                                    <center>
                                        <?= $this->Form->control('password',["class"=>"form-control"]); ?>
                                        <center>
                                            <div class="d-flex align-items-center justify-content-center mt-4 mb-0">

                                                <!-- <a class="small" href="../Users/login.php">Return to login</a> -->
                                                <div class="bttn">
                                                    <?= $this->Form->submit('Reset Password',['class'=>'btn btn-primary', 'style'=>'width:auto;']) ?>
                                                </div>
                                            </div>
                                            <?= $this->Form->end() ?>
                                </div>


                                <!--
                                                                            <div class="form-floating mb-3">
                                                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                                                                <label for="inputEmail">Email address</label>
                                                                            </div> -->
                                <!-- <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="../Users/login.php">Return to login</a>
                                    <a class="btn btn-primary" href="resetsuccess.html" >Reset Password</a>
                                </div> -->

                            </div>
                            <div class="card-footer text-center py-3">


                                <div class="help">

                                    <div class="question">?</div>

                                    <div class="popup">
                                        <h3>How should I create a strong password?</h3>
                                        <div style="padding-left:1vw;">
                                            <p >A good password must:</p>
                                            <ul style="line-height:1em;padding-left:2vw;">
                                                <li>Be at least 8 characters</li>
                                                <li>Have at least one number</li>
                                                <li>Have at least one symbol</li>
                                                <li>Have at least one upper case letter</li>
                                                <li>Have at least one lower case letter</li>
                                            </ul>
                                            <p>If you still require further assistance, please contact an administrator.</p>
                                        </div>
                                    </div>

                                </div>
                                <style>

                                    body {
                                        padding: 15.6vw;
                                        font-family: ubuntu;
                                    }

                                    .help {
                                        width: 40px;
                                        margin: 0 auto;
                                    }

                                    .help .question {
                                        height: 40px;
                                        width: 40px;
                                        background: #ccc;
                                        font-size: 32px;
                                        line-height: 40px;
                                        text-align: center;
                                        border-radius: 50%;
                                        cursor: pointer;
                                    }

                                    .help .popup, .help .popup2 {
                                        width: 560px;
                                        height: 0px;
                                        text-align: left;
                                        overflow: hidden;
                                        position: relative;
                                        background: #eee;
                                        opacity: 0;
                                        transition: 1s;
                                        border-radius: 15px 15px 15px 15px;
                                    }

                                    .help .popup {
                                        left: -260px;
                                        top: 10px;
                                    }

                                    .help .popup2 {
                                        height: 220px;
                                    }

                                    .help .popup2 h4 {
                                        font-size: 18px;
                                        padding: 10px;
                                        margin: 0;
                                    }

                                    .help:hover .popup {
                                        opacity: 1;
                                        height: 230px;
                                    }

                                    .help .tell-me p:first-child {
                                        color: #e91e63;
                                        cursor: pointer;
                                    }

                                    .tell-me {
                                        width: 150px;
                                    }

                                    .help .tell-me:hover .popup2 {
                                        top: -220px;
                                        opacity: 1;
                                    }

                                    .help .popup h3 {
                                        margin: 0;
                                        padding: 10px 0 0 10px;
                                        height: 30px;
                                        background: #555;
                                        color: #fff;
                                        font-weight: 400;
                                        font-size: 18px;
                                    }

                                    .help .popup p {
                                        font-size: 16px;
                                        padding: 10px;
                                        margin: 0;
                                    }

                                    .help .popup .popup2 .sub-levels {
                                        padding: 0 0 10px 140px;
                                    }

                                    .help .popup .popup2 .sub-levels strong {
                                        font-size: 20px;
                                    }

                                    .help .popup .popup2 p:nth-child(5) {
                                        padding: 20px 0 0 10px;
                                    }

                                    .help .popup a {
                                        text-decoration: none;
                                        color: #e91e63;
                                    }

                                    .help .popup a:visited {
                                        color: #e91e63;
                                    }

                                    .help .popup p em {
                                        font-size: 12px;
                                    }
                                </style>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>


</html>



