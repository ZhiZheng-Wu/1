<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TenancyHistory $tenancyHistory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tenancy History'), ['action' => 'edit', $tenancyHistory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tenancy History'), ['action' => 'delete', $tenancyHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tenancyHistory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tenancy Histories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tenancy History'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tenancyHistories view content">
            <h3><?= h($tenancyHistory->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Tenant') ?></th>
                    <td><?= $tenancyHistory->has('tenant') ? $this->Html->link($tenancyHistory->tenant->id, ['controller' => 'Tenants', 'action' => 'view', $tenancyHistory->tenant->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= h($tenancyHistory->category) ?></td>
                </tr>
                <tr>
                    <th><?= __('File') ?></th>
                    <td><?= h($tenancyHistory->file) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tenancyHistory->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
