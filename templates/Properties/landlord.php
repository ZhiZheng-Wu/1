<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \App\Model\Entity\Property[]|\Cake\Collection\CollectionInterface $properties
 */

// DataTable JS plugin
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);

use Cake\Utility\ArrayHelper;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php $this->disableAutoLayout() ?>

<style>

.separator {
    height: 2px;
    margin-bottom: 15px;
    margin-bottom: 0.9375rem;
}

    input[type='search'], select {
        width: auto;
        height:auto;
    }

    label {
        font-size: 1em;
    }
    /* Trick: */
    footer{
        padding-top: 10px;
    }
    body {
    }

    * {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    form {
        max-width: 1100px;
        width: 100%;
    }

    /* Search Form */
    .styled-input {
        float: left;
        background: #e91e63;
        border: 2px solid black;
        border-radius: 50px;
        -webkit-box-shadow: inset 0 -1px 4px 0 rgba(0, 0, 0, 0.2);
        box-shadow: inset 0 -1px 4px 0 rgba(0, 0, 0, 0.2);
        width: 100%;
        position: relative;
        margin-bottom: 10px;
        font-family: "Lato", sans-serif;
    }

    .styled-input.multi {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: stretch;
        -ms-flex-align: stretch;
        align-items: stretch;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        height: auto;
    }

    .styled-input label {
        color: white;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 1.92px;
        position: absolute;
        top: 0;
        left: 0;
        -webkit-transition: all 0.25s cubic-bezier(0.2, 0, 0.03, 1);
        -o-transition: all 0.25s cubic-bezier(0.2, 0, 0.03, 1);
        transition: all 0.25s cubic-bezier(0.2, 0, 0.03, 1);
        pointer-events: none;
    }

    .styled-input.multi label {
        padding: 0px 0 0;
    }

    .styled-input.active {
        border: 1px solid #d0e5ba;
        -webkit-box-shadow: inset 0 -2px 4px 0 #d5eebb;
        box-shadow: inset 0 -2px 4px 0 #d5eebb;
    }

    .styled-input .icon--check,
    .styled-input .icon--error,
    .styled-input .chevron-down {
        display: inline-block;
        position: absolute;
        top: 50%;
        right: 2%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        z-index: 0;
    }

    .styled-input .icon--check,
    .styled-input .icon--error {
        display: none;
    }

    .styled-input .icon--check {
        right: 0%;
    }

    .styled-input input.success ~ .icon--check,
    .styled-input input.error ~ .icon--error {
        display: inline-block;
    }

    .styled-input label.error,
    .styled-input input:focus ~ label.error,
    .styled-input input#fn:valid ~ label.error,
    .styled-input input#ln:valid ~ label.error {
        font-size: 15px;
        text-transform: none;
        letter-spacing: normal;
        color: #ff523d;
        top: 53px;
        left: -3px;
    }

    .styled-input.multi.error {
        margin-bottom: 20px;
    }

    .styled-input.multi > div {
        position: relative;
        width: 100%;
        border-right: 2px solid #ccc;
    }

    .styled-input.multi > div:nth-last-of-type(1) {
        border-right: 0;
    }

    .styled-input.multi > div input,
    .styled-input.multi > div label {
        padding-left: 12px;
    }

    .styled-input.multi > div input {
        padding-top: 30px;
    }

    .styled-input input:focus,
    .styled-input textarea:focus,
    .styled-input select:focus {
        outline: none;
    }

    .styled-input input,
    .styled-input textarea,
    .styled-input select {
        color: #cccccc;
        border: 0;
        width: 90%;
        font-size: 15px;
        padding-top: 20px;
        background: transparent;
    }

    .styled-input select {
        width: 100%;
        background: transparent;
        border: 0;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        position: relative;
        z-index: 1;
        left: 0px;
    }

    /* Focus Label */

    .styled-input input:focus ~ label,
    .styled-input input#fn:valid ~ label,
    .styled-input input#ln:valid ~ label,
    .styled-input input#city[filled="true"]:valid ~ label,
    .styled-input #select-state label {
        font-size: 13px;
        letter-spacing: 1.56px;
        color: #4a3b8f;
        top: -12.8px;
        -webkit-transition: all 0.125s cubic-bezier(0.2, 0, 0.03, 1);
        -o-transition: all 0.125s cubic-bezier(0.2, 0, 0.03, 1);
        transition: all 0.125s cubic-bezier(0.2, 0, 0.03, 1);
    }

    @media (min-width: 991px) {
        .styled-input.multi {
            height: 70px;
        }
    }

    @media (min-width: 768px) and (max-width: 990px) {
        .styled-input.multi {
            height: 60px;
            padding: 8px 0;
        }
        .styled-input.multi > div input {
            padding-top: 18px;
        }
        .styled-input.multi label {
            padding: 7px 0 0;
        }
        .styled-input input#fn:valid ~ label,
        .styled-input input#ln:valid ~ label,
        .styled-input input#city[filled="true"]:valid ~ label,
        .styled-input.multi input:focus ~ label,
        .styled-input #select-state label {
            top: -9px;
        }
        .styled-input.multi.error {
            margin-bottom: 30px;
        }
        .styled-input label.error,
        .styled-input input:focus ~ label.error,
        .styled-input input#fn:valid ~ label.error,
        .styled-input input#ln:valid ~ label.error {
            font-size: 13px;
            top: 53px;
        }
        .search-area .form-area button.serach-btn {
            height: 60px;
            padding: 0;
        }
    }

    @media (max-width: 767.98px) {
        .examples [class^="col-"] {
            padding: 0;
        }

        .styled-input.multi > div {
            background-color: #fff;
            margin-bottom: 10px;
            display: block;
            border: 1px solid #efefef;
            border-radius: 3px;
            -webkit-box-shadow: inset 0 -1px 4px 0 rgba(0, 0, 0, 0.2);
            box-shadow: inset 0 -1px 4px 0 rgba(0, 0, 0, 0.2);
            width: 100%;
            padding: 16px 16px 8px 11.2px;
            height: 50px;
        }

        .styled-input.multi {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            border: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
            background: transparent;
            margin-bottom: 0;
        }

        .styled-input.multi > div label {
            padding: 12px 0 0 12px;
        }
        .styled-input.multi > div input:valid ~ label,
        .styled-input.multi > div input:focus ~ label,
        .styled-input.multi #select-state > label {
            padding-top: 15px;
        }

        .styled-input.multi > div input {
            padding-left: 0;
            padding-top: 2px;
            position: relative;
            z-index: 2;
            width: 100%;
        }
        .styled-input select {
            left: 0;
            padding-top: 2px;
        }

        .styled-input.multi.error {
            margin-bottom: 0;
        }

        .styled-input.multi > div.error {
            margin-bottom: 30px;
        }

        .styled-input.multi > div.error label.error {
            padding-top: 0;
        }
    }

    /* Button */

    .no-pad-left-10 {
        padding-left: 5px;
    }

    @media (max-width: 991px) and (min-width: 768px) {
        .no-pad-left-10 {
            padding-left: 0px;
            margin-left: -5px;
            width: calc(16.66666667% + 5px);
        }
    }

    @media (max-width: 767px) {
        .no-pad-left-10 {
            padding-left: 15px;
            margin-left: 0;
        }
    }

    .form-area button.serach-btn {
        border-radius: 6px;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border: none;
        font-size: 24px;
        background: #e91e63;
        text-align: center;
        color: white;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1.01px;
        width: 100%;
        height: 70px;
        -o-transition: all 0.25s ease-out;
        transition: all 0.25s ease-out;
        -webkit-transition: all 0.25s ease-out;
        -moz-transition: all 0.25s ease-out;
    }

    .form-area button.serach-btn:hover {
        background: #2E0D14;
        -webkit-box-shadow: -2px -2px 4px -4px rgba(0, 0, 0, 0.02),
        0 3px 9px 0 rgba(0, 0, 0, 0.1), 0 2px 4px 0 rgba(0, 0, 0, 0.14);
        box-shadow: -2px -2px 4px -4px rgba(0, 0, 0, 0.02),
        0 3px 9px 0 rgba(0, 0, 0, 0.1), 0 2px 4px 0 rgba(0, 0, 0, 0.14);
    }

    .form-area button.serach-btn:focus {
        outline: none;
    }

    @media only screen and (max-width: 991px) {
        .form-area button.serach-btn {
            font-size: 20px;
            height: 60px;
            padding: 0;
        }
    }

    @media only screen and (max-width: 767px) {
        .form-area button.serach-btn {
            font-size: 22px;
            padding: 7px 20px;
            width: 100%;
            height: 50px;
            border-radius: 6px;
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            margin-top: -12px;
            margin-bottom: 20px;
        }
        .separator {
            height: 2px;
            margin-bottom: 15px;
            margin-bottom: 0.9375rem;
        }



    }

    .leftinfo{
        margin-left: 50%;
        padding-top: 80px;
        margin-bottom:0;
        padding-bottom: 0;
        font-weight: bold;
        bottom: 0;
        font-size: 20px;
    }

    .rightinfo{
        font-weight: bold;
        padding-top: 80px;
        margin-bottom:10px;
        padding-bottom: 0;
        font-size: 20px;

    }

    .info{
        width: auto;
        height: 1600px;
        margin-bottom:0;
        padding-bottom: 0;
        bottom: 0;
        background:linear-gradient(to right, #ff1461,#ffffff, #ffffff, #ffffff,#ffffff,#ffffff,#ffffff,#ffffff,#ffffff,#ff1461);
        background-size: auto 500px;
    }

   


    .profile-wrapper {
        margin-top: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }
    .profile-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: row;
        margin: 20px;
        overflow: hidden;
        width: 80%;
    }
    .profile-pic {
        width: 50%;
        height: auto;
        object-fit: cover;
    }
    .profile-info {
        padding: 20px;
        width: 50%;
    }
    .profile-info h1 {
        font-size: 30px;
        color:black;
        margin-bottom: 10px;
    }
    .profile-info h2 {
        font-size: 24px;
        
        margin-bottom: 5px;
    }
    .profile-info p {
        font-size: 18px;
        color:black;
        margin-bottom: 5px;
    }
    .profile-info i {
        color:black;
        font-style: italic;
    }
    .star-rating {
    font-size: 24px;
}

.star-rating .fa-star {
    color: #ddd;
    cursor: pointer;
}

.star-rating .fa-star.active,
.star-rating .fa-star:hover {
    color: #ff9f00;
}

.rating-value {
    display: none;
}
</style>




<!--START HEAD-->
<head>


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
                    <li class="HillSide"><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'tenantshome']) ?></li>
                    <li><?= $this->Html->link(__('Properties for rent'), ['controller' => 'Properties', 'action' => 'membership']) ?></li>
                    <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</header>


<div class="info">

<div class="row">

    
        <div class="container">
        <?= $this->Html->link(__('< Back to properties page'), ['controller' => 'Properties', 'action' => 'membership'],['class'=>'btn btn-danger','style'=>'width:15vw;font-size:1.5vh;margin-top:50px']) ?>
        <div class="profile-wrapper">
    <div class="profile-card">
        <?php if($user->profile_pic){
            echo $this->Html->image($user->profile_pic, ['fullBase' => false, 'class' => 'profile-pic']);
        }else{
            echo  '<i class="profile-pic"> ** No image available ** </i> ';
        }
        ?> 
        <div class="profile-info">
            <h2>Landlord name</h2>
            <p><?php echo h(substr($user->full_name, 0)) ?></p>
            <h2>Gender</h2>
            <p><?php echo ucfirst($user->gender); ?></p>
            <h2>Email Address</h2>
            <p><?= h($user->email) ?></p>
            
            <h2>Phone Number</h2>
            <p><?= h($user->phone_number) ?></p>
            
        </div>
    </div>
</div>

<div class="ratings">
    <h2>Enter Your Ratings</h2>
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'Ratings', 'action' => 'add']]); ?>
<?php echo $this->Form->hidden('landlord_id', ['value' => $user->id]); ?>
<div class="form-group">
    <?php echo $this->Form->label('rating', 'Rating'); ?>
    <div class="star-rating">
        <span class="fa fa-star" data-rating="1"></span>
        <span class="fa fa-star" data-rating="2"></span>
        <span class="fa fa-star" data-rating="3"></span>
        <span class="fa fa-star" data-rating="4"></span>
        <span class="fa fa-star" data-rating="5"></span>
        <input type="hidden" name="rating" class="rating-value" value="0">
    </div>
</div>
<div class="form-group">
    <?php echo $this->Form->label('comment', 'Comment'); ?>
    <?php echo $this->Form->textarea('comment', ['rows' => '3', 'class' => 'form-control']); ?>
</div>
<div class="form-group">
    <?php echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']); ?>
</div>
<?php echo $this->Form->end(); ?>

</div>



<div class="user-properties">
  <h2>Properties owned by <?= h($user->full_name) ?></h2>
  <div class="row">
    <?php foreach ($user->properties as $property): ?>
      <div class="col-md-4 md-margin-bottom-40">
        <div class="card small">
          <div class="card-image">
            <?php if($property->placeholder): ?>
              <?= $this->Html->image($property->placeholder, ['class' => 'img-responsive', 'fullBase' => true, 'style' => 'height: 240px;']); ?>
            <?php else: ?>
              <div style="text-align: center; height: 240px; line-height: 200px; font-weight: 700; font-size: 1vw;">Image is not available</div>
            <?php endif; ?>
          </div>
          <div class="card-content">
            <p><span class="price"><?php echo '$' . $property->weekly_rent . ' per week' ?></span></p>
            <h4><?php echo h($property->street) ?></h4>
            <h5><?php echo h($property->suburb) . ', ' .  h($property->postcode) ?> </h5>
            <?= $this->Html->link(__('Details'), ['action' => 'details', $property->id], ['class' => 'btn btn-details', 'label' => 'Details']) ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>




            
        </div>
        
    </div>
</div>
</div>






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
    
<script>
    $(document).ready(function(){
    $('.star-rating .fa-star').click(function(){
        var rating = $(this).data('rating');
        $('.rating-value').val(rating);
        $('.star-rating .fa-star').removeClass('checked');
        for (var i = 1; i <= rating; i++){
            $('.star-rating .fa-star[data-rating="'+i+'"]').addClass('checked');
        }
    });
});

$(document).ready(function(){
  $('.star-rating .fa-star').click(function(){
    var rating = $(this).data('rating');
    $('.rating-value').val(rating);
    $('.star-rating .fa-star').css('color', '#c2c2c2');
    for (var i = 1; i <= rating; i++){
      $('.star-rating .fa-star[data-rating="'+i+'"]').css('color', '#ffd700');
    }
  });
});
</script>
