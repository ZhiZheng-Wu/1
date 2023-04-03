<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */

// DataTable JS plugin
echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    input[type='search'], select {
        width: auto;
        height:auto;
    }

    label {
        font-size: 1em;
    }
</style>
<nav class="top-nav">
    <div class="top-nav-title">

        <a href="<?= $this->Url->build('/') ?> "><?= $this->Html->image('pogo.png')?></a>
    </div>
    <div class="top-nav-links">

        <?= $this->Html->link(__(
            '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">view_list</i></span>
                 <span class="text">View Users</span>'
        ), ['controller'=>'Users','action' => 'index'],['escape' => false, 'class'=>'btn btn-info btn-icon-split']) ?>

    </div>
</nav>
<br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Archived Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="table-responsive">
                <table id="usersTable" class="table table-bordered">
                    <thead>
                    <tr>
                        <!--                    <th><?= h('ID') ?></th>-->
                        <th><?= h('First Name') ?></th>
                        <th><?= h('Last Name') ?></th>
                        <th><?= h('Verified') ?></th>
                        <th><?= h('Role') ?></th>
                        <th><?= h('Phone') ?></th>
                        <th><?= h('Email') ?></th>
                        <th><?= h('Gender') ?></th>

                        <th><?= h('Date of Birth') ?></th>

                        <th style="margin-left:-20px"><?= h('Last Updated') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>

                        <!-- removed: Weekly Budget, Children, Moving Date, About, Pet,Response Rate     -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= h($user->first_name) ?></td>
                            <td><?= h($user->last_name) ?></td>
                            <td><?php
                                if($user->site_access == '1'){
                                    echo '<p style="background-color:green;color:White;width:100%;text-align:center;font-weight:bold;font-style:italic;border-radius:25px;">Yes</p>';
                                }else{
                                    echo '<p style="background-color:red;color:White;width:100%;text-align:center;font-weight:bold;font-style:italic;border-radius:25px;">No</p>';                   }
                                ?></td>
                            <td><?=ucfirst(h($user->role)) ?></td>
                            <td><?= h($user->phone_number) ?></td>
                            <td><?php

                                if(strlen(($user->email))>15){
                                    echo h(substr($user->email, 0,14)) . "...";
                                }else{
                                    echo h($user->email);
                                }


                                ?></td>
                            <td><?php echo ucfirst($user->gender);
                                ?></td>

                            <!--Displaying date as dd-mm-yy -->
                            <td><?=h($user->date_of_birth)?>&nbsp;</td>

                            <!--Displaying date as dd-mm-yy -->
                            <td><?=h($user->last_updated); ?>&nbsp;</td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                                <?php $userfullname = $user->first_name . " " . $user->last_name; /* so won't use id */ ?>
<!--                                $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete user: {0}?', $userfullname), 'class' => 'side-nav-item'])-->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            $(document).ready( function () {
                $('#usersTable').DataTable();
            } );
        </script>
