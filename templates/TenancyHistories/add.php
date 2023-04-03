<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TenancyHistory $tenancyHistory
 * @var \Cake\Collection\CollectionInterface|string[] $tenants
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

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Tenancy Histories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tenancyHistories form content">
            <?= $this->Form->create($tenancyHistory) ?>
            <fieldset>
                <legend><?= __('Add Tenancy History') ?></legend>
                <?php
                    echo $this->Form->control('tenant_id', ['options' => $tenants]);
                    echo $this->Form->control('category');
                    echo $this->Form->control('document');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
