<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<h1 class="h3 mb-4 text-gray-800">User Details</h1>


<div class="row">
    <aside class="column">
        <div class="side-nav" style="padding: 12px">
            <h4 class="heading"><?= __('Actions') ?> </h4>
            <?= $this->Html->link(
                '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">edit</i></span>
                         <span class="text">Edit User</span>',
                ['action' => 'edit', $user -> id],
                ['escape' => false, 'class'=>'btn btn-primary btn-icon-split'])
            ?>



            <?= $this->Html->link(__(
                '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">view_list</i></span>
                 <span class="text">View Users</span>'
            ), ['controller'=>'Users','action' => 'index'],['escape' => false, 'class'=>'btn btn-info btn-icon-split']) ?>



            <?php $userfullname = $user->first_name . " " . $user->last_name; /* so won't use id */ ?>
<!--            $this->Form->postLink(-->
<!--                '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">delete</i></span>-->
<!--                <span class="text">Delete User</span>',-->
<!---->
<!--                ['action' => 'delete', $user->id],-->
<!--                ['escape' => false,  'confirm' => __('Are you sure you want to delete user: {0}?', $userfullname), 'class'=>'btn btn-danger btn-icon-split'])-->


            <?= $this->Html->link(
                '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">add</i></span><span class="text">New User</span>',['action' => 'add'],['escape' => false,'class'=>'btn btn-success btn-icon-split'])
            ?>
        </div>
    </aside>
</div>

<br>


<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Full name</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo h(substr($user->full_name, 0)) ?></div>
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
                            Email Address</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($user->email) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Date of Birth</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($user->date_of_birth) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Role</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=ucfirst(h($user->role)) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Phone Number</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($user->phone_number) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Gender</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ucfirst($user->gender);
                          ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pet</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if($user->pet == 0){
                                echo "No";
                            } else{
                                echo "Yes";
                            } ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Relationship Status</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ucfirst($user->relationship_status) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Children</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if($user->children == 0){
                                echo "No";
                            } else{
                                echo "Yes";
                            } ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Last Updated</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($user->last_updated) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>















