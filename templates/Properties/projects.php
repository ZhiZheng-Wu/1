<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Property[]|\Cake\Collection\CollectionInterface $properties
 */

// DataTable JS plugin
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
use Cake\Utility\ArrayHelper;


?>

<?php $this->disableAutoLayout() ?>

<style>
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
                    <li class="HillSide"><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display']) ?></li>
                    <li><?= $this->Html->link(__('Properties for rent'), ['controller' => 'Properties', 'action' => 'projects']) ?></li>
                    <li><?= $this->Html->link(__('About Us'), ['class' => 'waves-effect waves-dark', 'controller' => 'Pages', 'action' => 'about']); ?></li>
                    <li><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- PROPERTIES FOR RENT HEADING -->
<section id="inner-headline" style="background-color: #e91e63">
    <div class="container" >
        <div class="row" >
            <div class="col-lg-12">
                <h2 class="pageTitle" style="color: white">Properties For Rent</h2>
            </div>
        </div>
    </div>
</section>

<!--SEARCH FOR PROPERTIES-->
<section id="content">
    <div class="container" style="padding-bottom:2vw">
        <!-- Service blocks -->
        <div>
            <form action="#" id="header-search-people" class="form-area" novalidate="novalidate" autocomplete="off">
                <?= $this ->Form->create(null,['type'=>'get']) ?>
                <div class="row">
                    <div class="col-md-10">
                        <div class="styled-input wide multi">
                        <!-- SUBURB-->
                            <div class="first-name" id="input-first-name">
                            <?= $this->Form->control('suburb', [
                           'label'=>"",
                           'value' => $this->request->getQuery('suburb'),
                           'placeholder' => 'e.g. Melbourne',
                           'type' => 'text',
                           'pattern' => '[a-zA-Z]+',
                           'style' => 'border: none; outline: none;  background-color: transparent; box-shadow: none;font-weight: bold;margin-left: 10px;color:#cccccc',
                            ]) ?>
                            <label style="color: white;margin-left: 10px;">Suburb</label>

                            </div>
                            <!-- ROOM SIZE-->
                            <div class="last-name" id="input-last-name">
                            <?= $this->Form->control('room_min', [
                           'label' => '',
                           'min' => 0,
                           'max' => 100,
                           'empty' => 'Select room',
                           'options' => [0=>'Any', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'],
                           'value' => $this->request->getQuery('room_min'),
                           'style' => 'height: 68px; margin-top: 6px;font-weight: bold;',
                           'class' => 'form-control bg-light border-0 small selectSearch',
                            ]) ?>

                                <label style="color: white">Room size</label>
                                <svg class="icon--check" width="21px" height="17px" viewBox="0 0 21 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round">
                                        <g id="UI-Elements-Forms" transform="translate(-255.000000, -746.000000)" fill-rule="nonzero" stroke="#81B44C" stroke-width="3">
                                            <polyline id="Path-2" points="257 754.064225 263.505943 760.733489 273.634603 748"></polyline>
                                        </g>
                                    </g>
                                </svg>

                                <svg class="icon--error" width="15px" height="15px" viewBox="0 0 15 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round">
                                        <g id="UI-Elements-Forms" transform="translate(-550.000000, -747.000000)" fill-rule="nonzero" stroke="#D0021B" stroke-width="3">
                                            <g id="Group" transform="translate(552.000000, 749.000000)">
                                                <path d="M0,11.1298982 L11.1298982,-5.68434189e-14" id="Path-2-Copy"></path>
                                                <path d="M0,11.1298982 L11.1298982,-5.68434189e-14" id="Path-2-Copy-2" transform="translate(5.564949, 5.564949) scale(-1, 1) translate(-5.564949, -5.564949) "></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>

                            <!-- PRICE MIN -->
                            <div class="last-name" id="input-last-name">
                                <?=
                                $this ->Form->control('price_min',[
                                    'label'=>"", 
                                    'min' => 0,
                                    'max'=> 1000, 
                                    'value' =>$this->request->getQuery('price_min'),
                                    'placeholder' => 'e.g. 200',
                                    'type' => 'text',
                                    'pattern' => '^[0-9]{1,4}$', 
                                    'maxlength' => 4, 
                                    'style' => 'border: none; outline: none; background-color: transparent; box-shadow: none;font-weight: bold; margin-top: 2px; color:#cccccc !important;', 
                                    'class'=>'form-control bg-light border-0 small selectSearch'])?>
                                <label style="color: white" ">Price min</label>

                

                                <svg class="icon--check" width="21px" height="17px" viewBox="0 0 21 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round">
                                        <g id="UI-Elements-Forms" transform="translate(-255.000000, -746.000000)" fill-rule="nonzero" stroke="#81B44C" stroke-width="3">
                                            <polyline id="Path-2" points="257 754.064225 263.505943 760.733489 273.634603 748"></polyline>
                                        </g>
                                    </g>
                                </svg>

                                <svg class="icon--error" width="15px" height="15px" viewBox="0 0 15 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round">
                                        <g id="UI-Elements-Forms" transform="translate(-550.000000, -747.000000)" fill-rule="nonzero" stroke="#D0021B" stroke-width="3">
                                            <g id="Group" transform="translate(552.000000, 749.000000)">
                                                <path d="M0,11.1298982 L11.1298982,-5.68434189e-14" id="Path-2-Copy"></path>
                                                <path d="M0,11.1298982 L11.1298982,-5.68434189e-14" id="Path-2-Copy-2" transform="translate(5.564949, 5.564949) scale(-1, 1) translate(-5.564949, -5.564949) "></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>

                            <!--PRICE MAX -->
                            <div class="last-name" id="input-last-name">
                            <?=
                                $this ->Form->control('price_max',[
                                    'label'=>"", 
                                    'min' => 0,
                                    'max'=> 2000, 
                                    'value' =>$this->request->getQuery('price_max'),
                                    'placeholder' => 'e.g. 800',
                                    'type' => 'text',
                                    'pattern' => '^([1-9]\d{1,2}|1000)$', 
                                    'maxlength' => 4, 
                                    'style' => 'border: none; outline: none; background-color: transparent; box-shadow: none;font-weight: bold; margin-top: 2px;', 
                                    'class'=>'form-control bg-light border-0 small selectSearch'])?>
                                <label style="color: white">Price Max</label>

                                <svg class="icon--check" width="21px" height="17px" viewBox="0 0 21 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round">
                                        <g id="UI-Elements-Forms" transform="translate(-255.000000, -746.000000)" fill-rule="nonzero" stroke="#81B44C" stroke-width="3">
                                            <polyline id="Path-2" points="257 754.064225 263.505943 760.733489 273.634603 748"></polyline>
                                        </g>
                                    </g>
                                </svg>

                                <svg class="icon--error" width="15px" height="15px" viewBox="0 0 15 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round">
                                        <g id="UI-Elements-Forms" transform="translate(-550.000000, -747.000000)" fill-rule="nonzero" stroke="#D0021B" stroke-width="3">
                                            <g id="Group" transform="translate(552.000000, 749.000000)">
                                                <path d="M0,11.1298982 L11.1298982,-5.68434189e-14" id="Path-2-Copy"></path>
                                                <path d="M0,11.1298982 L11.1298982,-5.68434189e-14" id="Path-2-Copy-2" transform="translate(5.564949, 5.564949) scale(-1, 1) translate(-5.564949, -5.564949) "></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- SEARCH BUTTON -->
                    <div class="col-md-2 no-pad-left-10">
                        <button type="submit" class="primary-btn serach-btn" id="submit_btn" >SEARCH
                            <?= $this ->Form->end() ?></button>
                    </div>
                </div>
            </form>
            <!-- END FORM -->

            <script>
                $(function() {
                    // Focus Styling
                    const $input = $('.styled-input.multi input');

                    $input.on('focus', function() {
                        $(this).parent().parent().addClass('active');
                    });
                    $input.on('focusout', function() {
                        $(this).parent().parent().removeClass('active');
                    });

                    // Set data attribute to use for styling label when not a required field
                    $('.styled-input.multi input').blur(function() {
                        if ($(this).val()) {
                            $(this).attr('filled', 'true');
                        } else {
                            $(this).attr('filled', 'false');
                        }
                    });

                    //   // Error Handler
                    //   var $headerSearchPeople = $('#header-search-people');
                    //   var REQUEST_DELAY = 300; // ms
                    //   if ($headerSearchPeople.length !== 0) {

                    //     $headerSearchPeople.validate({
                    //       validClass: "success",
                    //       ignore: "",
                    //       rules: {
                    //         fn: {
                    //           required: true,
                    //           notEmail: true,
                    //           noEmptySpacesOnly: true,
                    //           atLeastOneLetter: true,
                    //         },
                    //         ln: {
                    //           required: true,
                    //           notEmail: true,
                    //           noEmptySpacesOnly: true,
                    //           atLeastOneLetter: true,
                    //         },
                    //         "city": {
                    //           notEmail: true,
                    //           emptyOrletters: true,
                    //         },
                    //       },
                    //       messages: {
                    //         fn: "Please enter a first name",
                    //         ln: "Please enter a last name",
                    //         city: "Please enter a valid city",
                    //       },

                    //       onkeyup: false,
                    //       onclick: false,
                    //       onsubmit: true,
                    //       submitHandler: function (form) {
                    //         // trackNL("Submitted Search Form - People");
                    //         window.setTimeout(function () {
                    //           dataArray = $(form).serializeArray();
                    //           var formVals = {};
                    //           _.forEach(dataArray, function (v, k) {
                    //             formVals[v.name] = v.value;
                    //           });

                    //           var data = _.mapValues(formVals, cleanSearchValues);
                    //           //data = parseMiddleInitial(data);

                    //           // form.submit();
                    //           // window.location.href = $(form).attr('action') + '?' + $.param(data);
                    //         }, REQUEST_DELAY);
                    //       }
                    //     });

                    //   }

                    //   // Check for errors and apply error classes when search submit button clicked
                    //   $('#submit_btn').click(function() {
                    //     setTimeout(function() {
                    //       errorCheck();
                    //       if($('.styled-input.multi input').hasClass('error')) {
                    //         $('.styled-input.multi').addClass('error');
                    //       }
                    //     }, 10);
                    //   });

                    //   function errorCheck(){
                    //     if($('#fn').hasClass('error')){
                    //       $('#fn').parent().addClass('error');
                    //     } else{
                    //       $('#fn').parent().removeClass('error');
                    //     };
                    //     if($('#ln').hasClass('error')){
                    //       $('#ln').parent().addClass('error');
                    //     } else{
                    //       $('#ln').parent().removeClass('error');
                    //     };
                    //     if($('#city').hasClass('error')){
                    //       $('#city').parent().addClass('error');
                    //     } else{
                    //       $('#city').parent().removeClass('error');
                    //     };
                    //   }
                });
            </script>




            <br>



            <?php $total = 0; ?>

            <?php foreach ($properties as $property): ?>
                <?php $total++; ?>
            <?php endforeach; ?>

            <?php
            if($total == 0 ){
                echo '<div class="list-group-item lg-margin-bottom-40" >';
                echo '<i style="font-size:2vh">No properties exist yet. Please contact an administrator to enter properties.</i>';
                echo '</div>';
            }
            ?>

<?php
    $propertiesArray = $properties->toArray(); 
    shuffle($propertiesArray); 
    $count = 0;
    foreach ($propertiesArray as $property):
        if($count < 6): 
?>
            <div class="list-group-item col-md-4 md-margin-bottom-40">
                <div class="card small">
                    <div class="card-image">
                        <?php if($property->placeholder){
                            echo $this->Html->image($property->placeholder, ['class'=>'img-responsive', 'fullBase' => true, 'style'=>'height: 240px;']);
                        }else{
                            echo '<div style="text-align: center;height: 240px; line-height: 200px;font-weight:700;font-size:1vw"> Image is not Available</div>';
                        } ?>
                    </div>
                    <div class="card-content">
                        <p><span class="price"><?php echo '$' . $property->weekly_rent . ' per week'  ?></span></p>
                        
                        <h5><?php echo $property->suburb . ', ' .  $property->postcode ?> </h5>
                        <!-- $this->Html->link(__('Details'), ['action' => 'progress', 'controller'=>'Pages'], ['class'=>'btn btn-details']) -->
                        <!-- Display details (still show admin side) -->
                    </div>
                </div>
            </div>
<?php
        endif;
        $count++;
    endforeach;
?>



        </div>

    </div>

    <section id="inner-headline" style="background-color: #e91e63">
        <div class="container" >
            <div class="row" >
                <div class="col-lg-12">
                    <h2 class="pageTitle" style="color: white">Call us or email us to create membership!</h2>
                </div>
            </div>
        </div>
    </section>
</section>

<!-- FOOTER -->
<div class="separator"></div>
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


<script>
    $(document).ready( function () {
        $('#propertiesTable').DataTable();
    } );

    document.querySelector('#search-input').addEventListener('input',filterList);

    function filterList(){
        const searchInput = document.querySelector('#search-input');
        const filter = searchInput.value.toLowerCase();
        const listItems = document.querySelectorAll('.list-group-item');

        listItems.forEach((item)=>{
            let text = item.textContent;
            if (text.toLowerCase().includes(filter.toLowerCase())){
                item.style.display = '';
            }
            else{
                item.style.display = 'none';
            }
        });
    }
</script>
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



