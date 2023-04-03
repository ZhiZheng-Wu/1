<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TenancyHistory $tenancyHistory
 * @var string[]|\Cake\Collection\CollectionInterface $tenants
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tenancyHistory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tenancyHistory->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Tenancy Histories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tenancyHistories form content">
            <?= $this->Form->create($tenancyHistory) ?>
            <fieldset>
                <legend><?= __('Edit Tenancy History') ?></legend>
                <?php
                    echo $this->Form->control('tenant_id', ['options' => $tenants]);
                    echo $this->Form->control('category');
                    echo $this->Form->control('file');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
  <?php
  /**
   * @var \App\View\AppView $this
   * @var \App\Model\Entity\TenancyHistory $tenancyHistory
   * @var \Cake\Collection\CollectionInterface|string[] $tenants
   */
  ?>

</div>
