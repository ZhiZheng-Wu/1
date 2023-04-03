<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \Cake\Collection\CollectionInterface|string[] $properties
 * @var \Cake\Collection\CollectionInterface|string[] $preferences
 * @var \Cake\Collection\CollectionInterface|string[] $tenantTypes
 */

$role_to_index = [''=>'','tenant'=>'1', 'landlord'=>'2','staff'=>'3','admin'=>'4' ];
$gender_to_index = [''=>'','male'=>'1','female'=>'2','non-binary'=>'3'];
$rel_to_index=[''=>'','single'=>'2','married'=>'1'];
$pets_to_index = [''=>'','yes'=>'1','no'=>'0'];
$children_to_index = [''=>'','1'=>'0','2'=>'1', '3'=>'2', '4'=>'3', '5'=>'4+'];
?>
<?= $this->Html->css(['backendlibrary/fontawesome/all.min.css', 'backendlibrary/sb-admin-2.css', 'backendlibrary/custom.css']) ?>
<?= $this->Html->script(['backendlibrary/jquery.js', 'backendlibrary/bootstrap.bundle.min.js', 'backendlibrary/sb-admin-2.js', 'backendlibrary/add.js']) ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<h1 class="h3 mb-4 text-gray-800">Add New User</h1>


<div class="row">
    <aside class="column">
        <div class="side-nav">
            <!-- <h4 class="heading"><?= __('Actions') ?></h4> -->
            <!-- <?= $this->Html->link(__('List Properties'), ['action' => 'index'], ['class' => 'side-nav-item']) ?> -->
        </div>
    </aside>
    <?= $this->Form->create($user) ?>
    <div class="row" >
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                User Details</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                echo $this->Form->control('first_name', ['placeholder' => "Please enter a first name", 'class'=>'form-control bg-light border-0 small']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('last_name', ['placeholder' => "Please enter a last name", 'class'=>'form-control bg-light border-0 small']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('email',['placeholder' => "Please enter an email", 'class'=>'form-control bg-light border-0 small'])
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('date_of_birth',['class'=>'form-control bg-light border-0 small']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('phone_number', ['type'=>'number','id'=>'phoneNumberField', 'label' => "Phone Number", 'placeholder' => "Please enter a phone number", 'class'=>'number-2 form-control bg-light border-0 small']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('gender',['options' => ['1' => 'Male', '2' => 'Female', '3' => 'Non-binary'], 'empty' => "Please select a gender", 'class'=>'form-control bg-light border-0 small selectSearch','value'=>$gender_to_index[$user['gender']]]);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('role',['label'=>'Role', 'options' => ['1' => 'Tenant', '2' => "Landlord", '3' => "Staff", '4' => "Admin"],'empty' => "Please select a role", 'class'=>'form-control bg-light border-0 small selectSearch', 'value'=>$role_to_index[$user['role']]]);
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
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                User Details</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                echo $this->Form->control('relationship_status',['options' => ['1' => 'Single', '2' => 'Married'],'empty' => "Please select marital status", 'class'=>'form-control bg-light border-0 small selectSearch','value'=>$rel_to_index[$user['relationship_status']]]);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('site_access', ['label' => " Give this user site access?"]);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('pet',['label'=> " Does this user have any pets?"]);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('children',['label' => ' Does this user have any dependants?']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('last_updated',['class'=>'form-control bg-light border-0 small']);
                                ?>
                                <br>
                                <?php
                                echo $this->Form->control('password',['class'=>'form-control bg-light border-0 small']);
                                ?>
                                <br>
                            </div>
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
