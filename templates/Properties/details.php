<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Property $property
 */

?>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php
    echo $this->Html->css(['publiclibrary/materialize.min.css']);
    echo $this->Html->css(['publiclibrary/bootstrap.min.css']);
    echo $this->Html->css(['fancybox/jquery.fancybox.css']);
    echo $this->Html->css(['publiclibrary/flexslider.css']);
    echo $this->Html->css(['publiclibrary/zoomslider.css']);
    echo $this->Html->css(['publiclibrary/custom.css']);
    echo $this->Html->css(['publiclibrary/style']);
    echo $this->Html->css(['google-icon.css']);
    ?>





</head>

<?php $this->disableAutoLayout() ?>
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
                        <li class="HillSide"><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'tenantshome']) ?></li>
                        
				    <li class="dropdown">
                       
                        <ul class="dropdown-menu">
                            <li><?= $this->Html->link('Company', ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'about']); ?> </li>         <li><?= $this->Html->link('Our Team', ['class' => 'waves-effect waves-dark' , 'controller' => 'Pages', 'action' => 'about', '#' =>'anchorOurTeam' ]); ?> </li>
                        

                        </ul>
                    </li>
                        <li><?= $this->Html->link(__('Properties for rent'), ['controller' => 'Properties', 'action' => 'membership']) ?></li>
                        <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
                    </ul>
                </div>
            </div>
        </div>
	</header>
    
    <!-- end header -->


	<section id="content">
		<div class="container">

            <?= $this->Html->link(__('<  Back to properties page'), ['controller' => 'Properties', 'action' => 'membership'],['class'=>'btn btn-danger','style'=>'width:15vw;font-size:1.5vh']) ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp    
            <?= $this->Html->link(__('View landlord profile >'), ['controller' => 'Properties', 'action' => 'landlord', $landlord_id],['class'=>'btn btn-danger','style'=>'width:15vw;font-size:1.5vh']) ?>
            <br>
            <td>
    
        
</td>


            <br>
            
<!--
****ICONS THAT WERE REQUESTED ON TRELLO
            <i class="icon-info-blocks material-icons">sell</i>
            <i class="icon-info-blocks material-icons">table_bar</i>
            <i class="icon-info-blocks material-icons">local_atm</i>
            <i class="icon-info-blocks material-icons">phone</i>
-->
            
            <style>
                .separator {
    height: 2px;
    margin-bottom: 15px;
    margin-bottom: 0.9375rem;
}

            .ftb{
                display:grid;
                min-height: 50vh;
                
                grid-template-columns:  1fr 1fr 1fr 1fr;
                grid-template-rows:     1fr 0.6fr;
            }
                #mainimg{
                    grid-area: 1/1/2/2;
                }
                .titles{
                    grid-area: 1/3/2/6;
                }
                .titles div{
                    padding-bottom: 3vh;
                    font-weight: bold;
                }
                #data div{
                    padding-bottom: 3vh;

                }
                
                #under{
                    grid-area: 2/1/3/6;
                    margin-top: 6vh;
                    
                }
                #under table, #under div{
                    text-align: center;
/*                    border: 1px solid black;*/
                }
                .under-titles div{
                    font-size: 1.6vh;
                    font-weight: bold;
                    padding-bottom: 1.5vh;
              

                }
           
                #desc{
                    width:100%;
                    
                }
                tr.spaceUnder>td {
                    padding-bottom: 1.5em;
                }

                table, th, td {
                    border-collapse: collapse;
                }

                th, td {
                    border-color: gray;
                }
                </style>
        <div class="ftb">
            <div id="mainimg"><?php if($property->placeholder){
                echo $this->Html->image($property->placeholder, [
                    'fullBase' => false, 
                    'style' => 'width: 640px; height: 427px;',
                ]);
                
                    }else{
                        echo  '<i> ** No image available ** </i> ';
                    }
                    ?> 
            </div>

            <div class="titles">
                <table>
                    <th> </th>
                    <th> </th>
                    <tr class="spaceUnder">
                    <td><span class="material-icons md-18">pin_drop</span> Suburb</td>
                        <td><?= __(ucfirst($property->suburb)) ?></td>
                    </tr>
                    <tr class="spaceUnder">
                    <td><span class="material-icons md-18">map</span> State</td>
                        <td><?= __($property->state) ?></td>
                    </tr>
                    <tr class="spaceUnder">
                    <td><span class="material-icons md-18">real_estate_agent</span> Property Type</td>
                        <td><?= __(ucfirst($property-> property_type)) ?></td>
                    </tr>
                    <tr class="spaceUnder">
                    <td><span class="material-icons md-18">holiday_village</span> Stay Type</td>
                        <td><?php
                            if($property->stay_type == 0) {
                                echo $property -> stay_type = "Room";
                            } else
                                echo $property -> stay_type = "Whole House"
                            ?></td>
                    </tr>
                    <tr class="spaceUnder">
                    <td><span class="material-icons md-18">groups</span> Resident Limit</td>
                        <td><?php if($property->resident_limit == 0) {
                                echo $property -> resident_limit = "1";
                            } elseif ($property->resident_limit == 1) {
                                echo $property->resident_limit = "2";
                            } elseif ($property->resident_limit == 2) {
                                echo $property->resident_limit = "3";
                            } elseif ($property->resident_limit == 3) {
                                echo $property->resident_limit = "4";
                            } elseif ($property->resident_limit == 4) {
                                echo $property->resident_limit = "5";
                            } else $property->resident_limit = "6+"
                            ?></td>
                    </tr>
                    <tr class="spaceUnder">
                    <td><span class="material-icons md-18">date_range</span> Minimum Stay</td>
                        <td><?= $this->Number->format($property->min_stay) . ' months' ?></td>
                    </tr>
                    <tr class="spaceUnder">
                    <td><span class="material-icons md-18">date_range</span> Maximum Stay</td>
                        <td><?= $this->Number->format($property->max_stay) . ' months' ?></td>
                    </tr>
                    <tr class="spaceUnder">
                    <td><span class="material-icons md-18">request_quote</span> Bond</td>
                        <td>$<?= __($property->bond) ?></td>
                    </tr>
                    <tr class="spaceUnder">
                    <td><span class="material-icons md-18">payments</span> Weekly Rent</td>
                        <td>$<?= __($property->weekly_rent) ?></td>
                    </tr>
                </table>

            </div>
            <style>
            .filter-green{
            filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(86deg) brightness(118%) contrast(119%);
            }
            </style>

            <div id="under">
                 <table>
                     <hr>
                     <tr class="under-titles">
                         <td><div>Parking</div>  </td>
                         <td><div>Number of Bedrooms</div></td>
                         <td><div>Number of Bathrooms</div></td>
                         <td><div>Landlord</div></td>
                         <td><div>Contact</div></td>
                     </tr>
                     
                     <tr>
                         <td><div><span class="material-icons md-18">directions_car</span> <?= __(ucfirst($property->parking)) ?></div></td>
                         <td><div><span class="material-icons md-18">king_bed</span> <?= $this->Number->format($property->number_of_bedrooms) ?></div></td>
                         <td><div><span class="material-icons md-18">bathtub</span> <?= $this->Number->format($property->number_of_bathrooms) ?></div></td>
                         <td><div><span class="material-icons md-18">person</span> <?= $property->user->full_name ?></div></td>
                         <td><div><span class="material-icons md-18">call</span><?= $property->user->phone_number ?></div></td>

                     </tr>
                     </table>
                <br>
                <table id="desc">
                     <tr class="under-titles">
                         
                          <td><div>Description</div></td>
                     </tr>
                     <tr>
                      <td style = "font-size:18px"><div ><?= __($property->long_description) ?></div></td>
                     </tr>
                     <div class="separator"></div>
                     <div class="separator"></div>
                </table>
                <div class="separator"></div>
                <div class="separator"></div>
            </div>
            
        </div>

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
