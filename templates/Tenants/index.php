<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tenant[]|\Cake\Collection\CollectionInterface $tenants
 */
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
        <?= $this->Html->link(
            '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">add</i></span><span class="text">New Tenant</span>',['action' => 'add'],['escape' => false,'class'=>'btn btn-success btn-icon-split'])
        ?>
    </div>
</nav>
<br>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Properties</h6>
    </div>
    <div class="card-body">

    <div class="table-responsive">
        <table id="tenantsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th><?= h('user_id') ?></th>
                    <th><?= h('hidden') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tenants as $tenant): ?>
                <tr>
                    <td><?= $tenant->has('user') ? $this->Html->link($tenant->user->id, ['controller' => 'Users', 'action' => 'view', $tenant->user->id]) : '' ?></td>
                    <td><?= h($tenant->hidden) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $tenant->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tenant->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tenant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tenant->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

    <script>
        $(document).ready( function () {
            $('#tenantsTable').DataTable();
        } );
    </script>
