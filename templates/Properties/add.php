<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Property $property
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $extras
 * @var \Cake\Collection\CollectionInterface|string[] $tenantTypes
 */

?>
<?= $this->Html->css(['backendlibrary/fontawesome/all.min.css', 'backendlibrary/sb-admin-2.css', 'backendlibrary/custom.css']) ?>
<?= $this->Html->script(['backendlibrary/jquery.js', 'backendlibrary/bootstrap.bundle.min.js', 'backendlibrary/sb-admin-2.js', 'backendlibrary/add.js']) ?>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



<h1 class="h3 mb-4 text-gray-800">Add New Property</h1>

<div class="row">
    <aside class="column">
        <div class="side-nav">
           <!-- <h4 class="heading"><?= __('Actions') ?></h4> -->
            <!-- <?= $this->Html->link(__('List Properties'), ['action' => 'index'], ['class' => 'side-nav-item']) ?> -->
        </div>
    </aside>
    <?= $this->Form->create($property,['type'=>'file', 'accept'=>'image/*']) ?>
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Location Details</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                echo $this->Form->control('user_id',['label'=>"Landlords", 'class'=>'form-control bg-light border-0 small selectSearch', 'empty' => "Please select landlord"]);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('street',['label'=>"Street Address", 'placeholder' => "Please enter the street address", 'class'=>'form-control bg-light border-0 small']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('suburb',['label'=>"Suburb", 'placeholder' => "Please enter the suburb", 'class'=>'form-control bg-light border-0 small']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('postcode',['min' => 0, 'label'=>"Postcode", 'placeholder' => "Please enter the postcode", 'class'=>'form-control bg-light border-0 small']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('state', ['label'=>"State", 'empty' => "Please select the state", 'options' => [1 => 'VIC', 2 => 'NSW', 3 => 'SA', 4 => 'NT', 5 => 'QLD', 6 => 'WA', 7 => 'TAS', 8 => 'ACT'], 'class'=>'form-control bg-light border-0 small selectSearch']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('parking', ['class'=>'form-control bg-light border-0 small selectSearch', 'options' => [1 => 'No parking', 2 => 'Off Street Parking', 3 => 'On Street Parking'], 'empty' => "Please select the parking situation"]);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('image_file',['label'=> "Property Photos" ,'type'=>'file', 'accept'=>'image/*']);
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Property Details</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                echo $this->Form->control('long_description',['label'=> "Description",'rows' => '4', 'class'=>'form-control bg-light border-0 small', 'placeholder' => "Please enter a description"]);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('number_of_bedrooms',['label'=>"Number of Bedrooms", 'options' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'], 'empty' => "Please select the bedrooms", 'class'=>'form-control bg-light border-0 small selectSearch']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('number_of_bathrooms',['label'=>"Number of Bathrooms", 'min' => 0,'max'=> 100, 'empty' => "Please select the bathrooms",'options' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5+'], 'class'=>'form-control bg-light border-0 small selectSearch']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('bond',['label'=>"Bond ($ AUD)",'min' => 0, 'placeholder' => "Please add the bond", 'class'=>'form-control bg-light border-0 small']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('residency_limit',[ 'empty' => "Please enter the maximum tenants", 'options' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6+'],'class'=>'form-control bg-light border-0 small selectSearch']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('landlord_resident',['label'=>" Is the landlord also living at this property?"]);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('weekly_rent',['label'=>"Price per week ($ AUD)",'class'=>'form-control bg-light border-0 small', 'placeholder' => "Please enter the price per week"]);
                                ?>
                                <br>
                            </div>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Property Details Continued.</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                echo $this->Form->control('property_type',['options' => [1 => 'House', 2 =>'Flat', 3 => 'Townhouse', 4 => 'Apartment', 5 => 'Granny Flat', 6 => 'Student Accommodation'], 'empty' => "Please select the property type", 'class'=>'form-control bg-light border-0 small selectSearch']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('property_size', ['label'=>"Land Size (Sqm)",'class'=>'form-control bg-light border-0 small', 'placeholder' => "Please enter the land size in square metres"]);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('building_size', ['label'=>"Building Size (Sqm)",'class'=>'form-control bg-light border-0 small', 'placeholder' => "Please enter the building size in square metres"]);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('available', ['label' => " Is this property available?"]);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('min_stay',['label'=> "Minimum Stay (Months)",'min' => 0, 'placeholder' => "eg: 24 months", 'class'=>'form-control bg-light border-0 small']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('max_stay',['label'=> "Maximum Stay (Months)",'min' => 0, 'placeholder' => "eg: 36 months", 'class'=>'form-control bg-light border-0 small']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('women_only',['label'=>" Female only applicants"]);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('last_updated',['class'=>'form-control bg-light border-0 small']);
                                ?>
                            </div>
                            <br>
                        </div>
                        <div class="col-auto">
                        </div>
                        <br>
                        <?= $this->Form->button(__('Submit'), ['class'=>'form-control bg-light-custom border-0 small']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>