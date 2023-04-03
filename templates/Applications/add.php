<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Application $application
 * @var \Cake\Collection\CollectionInterface|string[] $tenants
 * @var \Cake\Collection\CollectionInterface|string[] $properties
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Applications'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="applications form content">
            <?= $this->Form->create($application) ?>
            <fieldset>
                <legend><?= __('Add Application') ?></legend>
                <?php
                    echo $this->Form->control('tenant_id', ['options' => $tenants]);
                    echo $this->Form->control('property_id', ['options' => $properties]);
                    echo $this->Form->control('tenant_hide');
                    echo $this->Form->control('landlord_hide');
                    echo $this->Form->control('tenant_cancel');
                    echo $this->Form->control('landlord_cancel');
                    echo $this->Form->control('accepted');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
